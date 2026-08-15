<?php

namespace App\Http\Controllers;

use App\Models\Course;
use Illuminate\Http\Request;
use App\Models\Setting;
use App\Models\Resource;
use App\Models\ContactMessage;
use Illuminate\Support\Facades\Http;


class HomeController extends Controller
{
    // HOME PAGE
    public function index()
    {
        $locale = app()->getLocale();
        
        $coursesQuery = Course::where('status', 'published')->latest();
        if ($locale === 'fr') {
            $coursesQuery->where('lang', 'fr');
        } else {
            $coursesQuery->where(function($q) {
                $q->where('lang', 'en')
                  ->orWhereNull('lang')
                  ->orWhere('lang', '');
            });
        }
        $courses = $coursesQuery->paginate(6);

        $resourcesQuery = Resource::latest();
        if ($locale === 'fr') {
            $resourcesQuery->where('lang', 'fr');
        } else {
            $resourcesQuery->where(function($q) {
                $q->where('lang', 'en')
                  ->orWhereNull('lang')
                  ->orWhere('lang', '');
            });
        }
        $resources = $resourcesQuery->take(3)->get();

        return view('index', compact('courses','resources'));
    }

    // ALL COURSES PAGE
    public function courses()
    {
        $locale = app()->getLocale();

        $coursesQuery = Course::where('status', 'published')->latest();
        if ($locale === 'fr') {
            $coursesQuery->where('lang', 'fr');
        } else {
            $coursesQuery->where(function($q) {
                $q->where('lang', 'en')
                  ->orWhereNull('lang')
                  ->orWhere('lang', '');
            });
        }
        $courses = $coursesQuery->paginate(9);

        $resourcesQuery = Resource::latest();
        if ($locale === 'fr') {
            $resourcesQuery->where('lang', 'fr');
        } else {
            $resourcesQuery->where(function($q) {
                $q->where('lang', 'en')
                  ->orWhereNull('lang')
                  ->orWhere('lang', '');
            });
        }
        $resources = $resourcesQuery->paginate(6);            

        return view('courses.index', compact('courses','resources'));
    }
    // SINGLE COURSE PAGE
    public function show($slug)
    {
        $locale = app()->getLocale();
        $query = Course::where(function($q) use ($slug) {
            $q->where('slug', $slug)
              ->orWhere('id', $slug);
        });

        if ($locale === 'fr') {
            $query->where('lang', 'fr');
        } else {
            $query->where(function($q) {
                $q->where('lang', 'en')
                  ->orWhereNull('lang')
                  ->orWhere('lang', '');
            });
        }

        $course = $query->with(['lessons', 'teacher', 'sections.lessons'])->firstOrFail();

        $lessonCount = $course->lessons->count();

        $studentCount = 0; // agar subscription system hai to change kar sakte ho

        return view('course_detail', compact(
            'course',
            'lessonCount',
            'studentCount'
        ));
    }
    // RESOURCES PAGE
    public function resources()
    {
        $settings = Setting::pluck('value', 'key')->toArray();
        $locale = app()->getLocale();

        $resourcesQuery = Resource::latest();
        if ($locale === 'fr') {
            $resourcesQuery->where('lang', 'fr');
        } else {
            $resourcesQuery->where(function($q) {
                $q->where('lang', 'en')
                  ->orWhereNull('lang')
                  ->orWhere('lang', '');
            });
        }
        $resources = $resourcesQuery->paginate(6);

        return view('resource', compact('settings','resources'));
    }

    //contact page
     public function contactUs()
    {
        $settings = Setting::pluck('value', 'key')->toArray();

        return view('contact', compact('settings'));
    }

   public function store(Request $request)
{
    $request->validate([
        'name'    => 'required|string|max:100',
        'email'   => 'required|email',
        'message' => 'required|string',
    ]);

    ContactMessage::create([
        'name'    => $request->name,
        'email'   => $request->email,
        'message' => $request->message,
        'lang'    => app()->getLocale(),
    ]);

    return back()->with('success', 'Message saved successfully!');
}

//about page
    public function about()
    {
        $settings = Setting::pluck('value', 'key')->toArray();

        return view('about', compact('settings'));
    }

    // AI Practice Dashboard view
    public function aiPractice(Request $request)
    {
        $settings = Setting::pluck('value', 'key')->toArray();
        $history = [];
        if (auth()->check()) {
            $history = \App\Models\AiPracticeAttempt::where('user_id', auth()->id())
                ->latest()
                ->take(10)
                ->get();
        }

        if ($request->has('course_id')) {
            $course = Course::find($request->course_id);
            if ($course) {
                if ($course->price > 0) {
                    $subscription = \App\Models\CourseUserSubscription::where('user_id', auth()->id())
                        ->where('course_id', $course->id)
                        ->latest()
                        ->first();
                    if (!$subscription || $subscription->payment_status === 'pending') {
                        return redirect()->route('users.checkout', $course->id)->with('error', 'Please complete the payment to access this course.');
                    }
                }
                session([
                    'active_course_id' => $course->id,
                    'active_custom_prompt' => $course->has_custom_prompt ? $course->custom_prompt : null
                ]);
            }
        } elseif (!session()->has('active_course_id')) {
            $latestCourse = Course::where('status', 'published')->where('has_custom_prompt', true)->latest()->first();
            if ($latestCourse) {
                session([
                    'active_course_id' => $latestCourse->id,
                    'active_custom_prompt' => $latestCourse->custom_prompt
                ]);
            }
        }

        return view('ai-practice', compact('settings', 'history'));
    }

    // AI Chat Handler
    public function chat(Request $request)
    {
        $request->validate([
            'message' => 'required|string',
            'history' => 'nullable|array',
        ]);

        $message = $request->input('message');
        $history = $request->input('history', []);

        if ($message === 'clear_session') {
            session()->forget(['active_practice_skill', 'active_practice_question', 'active_attempt_id']);
            return response()->json(['reply' => 'Session cleared.']);
        }

        if ($message === 'resume_attempt') {
            $attemptId = $request->input('attempt_id');
            $attempt = \App\Models\AiPracticeAttempt::where('user_id', auth()->id())->find($attemptId);
            if ($attempt) {
                session([
                    'active_practice_skill' => $attempt->skill,
                    'active_practice_question' => $attempt->question,
                    'active_attempt_id' => $attempt->id
                ]);
                return response()->json([
                    'success' => true,
                    'skill' => $attempt->skill,
                    'question' => $attempt->question,
                    'attempt_id' => $attempt->id
                ]);
            }
            return response()->json(['success' => false, 'error' => 'Attempt not found.']);
        }

        if ($message === 'start_practice_session') {
            $skill = $request->input('skill');
            $question = $request->input('question');
            
            $attempt = \App\Models\AiPracticeAttempt::create([
                'user_id' => auth()->id(),
                'course_id' => session('active_course_id'),
                'skill' => $skill,
                'question' => $question,
                'user_answer' => '',
                'score' => 'Pending',
                'feedback' => 'Pending evaluation',
            ]);

            session([
                'active_practice_skill' => $skill,
                'active_practice_question' => $question,
                'active_attempt_id' => $attempt->id
            ]);

            return response()->json([
                'success' => true,
                'attempt_id' => $attempt->id
            ]);
        }

        // Forget active practice session if starting fresh or switching modes
        $msgLower = strtolower($message);
        if (str_contains($msgLower, 'bonjour') || str_contains($msgLower, 'hello') || str_contains($msgLower, 'practice') || str_contains($msgLower, 'entraîner') || str_contains($msgLower, 'start') || str_contains($msgLower, 'commencer')) {
            session()->forget(['active_practice_skill', 'active_practice_question', 'active_attempt_id']);
        }

        $openAiKey = env('OPENAI_API_KEY');
        $geminiKey = env('GEMINI_API_KEY');

        $activeSkill = session('active_practice_skill');
        $activeQuestion = session('active_practice_question');
        $sessionCustomPrompt = session('active_custom_prompt');
        $activeSkillLower = strtolower($activeSkill ?? '');
        $activeCourseId = session('active_course_id');

        // Detect skill from request parameter or message if active skill is not set in session yet
        $detectedSkill = null;
        if ($request->filled('skill')) {
            $detectedSkill = strtolower($request->input('skill'));
        }

        if (!$activeSkillLower && !$detectedSkill) {
            $msgLower = strtolower($message);
            if (str_contains($msgLower, 'reading') || str_contains($msgLower, 'lecture') || str_contains($msgLower, 'lire')) {
                $detectedSkill = 'reading';
            } elseif (str_contains($msgLower, 'listening') || str_contains($msgLower, 'écoute') || str_contains($msgLower, 'ecoute') || str_contains($msgLower, 'écouter')) {
                $detectedSkill = 'listening';
            } elseif (str_contains($msgLower, 'writing') || str_contains($msgLower, 'écriture') || str_contains($msgLower, 'ecriture') || str_contains($msgLower, 'écrire')) {
                $detectedSkill = 'writing';
            } elseif (str_contains($msgLower, 'speaking') || str_contains($msgLower, 'conversation') || str_contains($msgLower, 'oral') || str_contains($msgLower, 'parler')) {
                $detectedSkill = 'speaking';
            }
        }

        // Fallback target skill detection if still null and a course is active
        if (!$activeSkillLower && !$detectedSkill && $activeCourseId) {
            $courseObj = Course::find($activeCourseId);
            if ($courseObj) {
                $titleLower = strtolower($courseObj->title);
                if (str_contains($titleLower, 'reading') || str_contains($titleLower, 'lecture')) {
                    $detectedSkill = 'reading';
                } elseif (str_contains($titleLower, 'listening') || str_contains($titleLower, 'écoute') || str_contains($titleLower, 'ecoute')) {
                    $detectedSkill = 'listening';
                } elseif (str_contains($titleLower, 'writing') || str_contains($titleLower, 'écriture') || str_contains($titleLower, 'ecriture')) {
                    $detectedSkill = 'writing';
                } elseif (str_contains($titleLower, 'speaking') || str_contains($titleLower, 'conversation') || str_contains($titleLower, 'oral')) {
                    $detectedSkill = 'speaking';
                }

                if (!$detectedSkill) {
                    $availableSkills = [];
                    $dbSkills = \App\Models\Prompt::where('course_id', $activeCourseId)->where('status', true)->pluck('skill')->toArray();
                    foreach ($dbSkills as $s) {
                        $availableSkills[] = strtolower($s);
                    }
                    if ($courseObj->has_custom_prompt && $courseObj->custom_prompt) {
                        $dec = json_decode($courseObj->custom_prompt, true);
                        if (json_last_error() === JSON_ERROR_NONE && is_array($dec)) {
                            foreach (['reading', 'listening', 'speaking', 'writing'] as $s) {
                                if (!empty($dec[$s])) {
                                    $availableSkills[] = $s;
                                }
                            }
                        }
                    }
                    $availableSkills = array_unique($availableSkills);
                    if (count($availableSkills) === 1) {
                        $detectedSkill = $availableSkills[0];
                    }
                }
            }
        }

        $targetSkill = $activeSkillLower ?: $detectedSkill;

        // Load prompt configured in Admin for the specific module/skill
        $customPrompt = $this->getModulePrompt($targetSkill, $activeCourseId);
        if (!$customPrompt && $sessionCustomPrompt) {
            if ($targetSkill && is_string($sessionCustomPrompt)) {
                $dec = json_decode($sessionCustomPrompt, true);
                if (json_last_error() === JSON_ERROR_NONE && is_array($dec) && !empty($dec[$targetSkill])) {
                    $customPrompt = $dec[$targetSkill];
                }
            } elseif (!$targetSkill && is_string($sessionCustomPrompt)) {
                $customPrompt = $sessionCustomPrompt;
            }
        }

        $systemPrompt = "You are FrancoWay's AI Study Assistant. Your goal is to help students practice their French or English language skills in 4 categories: Listening, Speaking, Writing, and Reading.

If a student asks to discuss, introduce, prepare for, or start a Reading, Writing, Listening, or Speaking module, you MUST immediately generate the actual exercise/passage/prompt/cue card wrapped inside the `<exercise skill=\"reading|writing|listening|speaking\">` tag. Do not output any introductory chat, greetings, or conversational questions before the tag for these skills; output the exercise block immediately so the student's interactive workspace opens right away.

Whenever you generate a new practice task/exercise for the student, you MUST wrap the complete task content (including the answers key at the bottom) inside `<exercise skill=\"reading|listening|writing|speaking\">...</exercise>` tags.

CRITICAL RULE FOR EXERCISES:
1. For Reading and Listening exercises, you MUST generate exactly 10 questions (numbered 1 to 10).
2. For Listening exercises, the questions MUST be directly and strictly based on the content of the generated transcript/dialogue, as that transcript will be converted to audio for the student. The transcript/dialogue MUST contain all the information necessary to answer the 10 questions.
3. You MUST always include a correct answers key at the very bottom of the generated exercise content (inside the `<exercise>` block) using the heading `### Answers` or `### Answer Key`.

For Reading exercises, structure it like this:
<exercise skill=\"reading\">
### 📖 Passage: [Title]
[Passage text...]

### Questions
1. [Question 1 text...]
2. [Question 2 text...]
3. [Question 3 text...]
4. [Question 4 text...]
5. [Question 5 text...]
6. [Question 6 text...]
7. [Question 7 text...]
8. [Question 8 text...]
9. [Question 9 text...]
10. [Question 10 text...]

### Answer Key
1. [Correct Answer 1] - [Short explanation]
2. [Correct Answer 2] - [Short explanation]
3. [Correct Answer 3] - [Short explanation]
4. [Correct Answer 4] - [Short explanation]
5. [Correct Answer 5] - [Short explanation]
6. [Correct Answer 6] - [Short explanation]
7. [Correct Answer 7] - [Short explanation]
8. [Correct Answer 8] - [Short explanation]
9. [Correct Answer 9] - [Short explanation]
10. [Correct Answer 10] - [Short explanation]
</exercise>

For Listening exercises, you MUST include a clean Transcript/Dialogue section so that our front-end text-to-speech engine can read the audio out loud to the student. Structure it like this:
<exercise skill=\"listening\">
### 🎧 Transcript: [Title or Topic]
[Write a clean, detailed dialogue script or monologue here. Make sure it is long and detailed enough to support 10 distinct questions. Format:
Speaker 1: ...
Speaker 2: ... ]

### Questions
1. [Question 1 text...]
2. [Question 2 text...]
3. [Question 3 text...]
4. [Question 4 text...]
5. [Question 5 text...]
6. [Question 6 text...]
7. [Question 7 text...]
8. [Question 8 text...]
9. [Question 9 text...]
10. [Question 10 text...]

### Answer Key
1. [Correct Answer 1] - [Short explanation]
2. [Correct Answer 2] - [Short explanation]
3. [Correct Answer 3] - [Short explanation]
4. [Correct Answer 4] - [Short explanation]
5. [Correct Answer 5] - [Short explanation]
6. [Correct Answer 6] - [Short explanation]
7. [Correct Answer 7] - [Short explanation]
8. [Correct Answer 8] - [Short explanation]
9. [Correct Answer 9] - [Short explanation]
10. [Correct Answer 10] - [Short explanation]
</exercise>

Do not wrap normal chat dialogue, explanations, greetings, or evaluations in this tag. Wrap ONLY the generated exercise itself.";

        if ($customPrompt) {
            $systemPrompt .= "\n\nCUSTOM COURSE RULES/GUIDELINES FOR GENERATION AND EVALUATION:\n{$customPrompt}";
            $systemPrompt .= "\n\nCRITICAL DIRECTIVE FOR CUSTOM COURSE RULES/GUIDELINES:
1. These custom course rules/guidelines provided by the admin have HIGHEST PRIORITY.
2. If these guidelines contain specific instructions (such as testing verb conjugation, single-sentence questions, specific passages, custom rules, or specific question lists), you MUST follow these custom instructions exactly.
3. Wrap the generated content inside `<exercise skill=\"{$targetSkill}\">...</exercise>`.
4. If no answer key is explicitly written in the custom prompt guidelines, generate the correct answer key yourself at the bottom using `### Answer Key`.";
        }

        if ($targetSkill) {
            $systemPrompt .= "\n\nCRITICAL DIRECTIVE FOR TARGET MODULE '{$targetSkill}':
1. You MUST generate ONLY a '{$targetSkill}' exercise wrapped in `<exercise skill=\"{$targetSkill}\">`.
2. Follow the custom course rules/guidelines provided above for this module. Only if no custom prompt guideline is provided for this module, generate a default standard exercise format (e.g. 10 questions for reading/listening).
3. Do NOT mix content from other modules. Do not generate reading passages when the active skill is writing or speaking.";
        }

        $systemPrompt .= "\n\nRules:
1. NEVER mention that you are OpenAI, ChatGPT, or Gemini. You are the native 'FrancoWay AI Study Assistant' developed by FrancoWay.
2. ALL conversation, practice prompts, passages, questions, and explanations MUST be in the language appropriate for the course or custom prompt (e.g., French for French courses/prompts, English for English courses/prompts). If the custom prompt specifies testing in a certain language (like French) or is written in French, you MUST generate all exercises, questions, and evaluations in that language.
3. Keep your tone encouraging, professional, and clear. Use Markdown to format all exercises beautifully.";

        if ($activeSkill && $activeQuestion) {
            $systemPrompt .= "\n\nCRITICAL CONTEXT: The user is currently in an active practice session for the skill: '{$activeSkill}'. The task/question they were given is:\n---\n{$activeQuestion}\n---\n\nIf the user's message is an answer or submission for this task, you MUST evaluate it in the language of the task (English or French). Provide a clear score (e.g. Band score or X/Y) and feedback. If it is indeed their answer, append a JSON block inside `<evaluation>` tags at the very end of your response like this:\n<evaluation>\n{\n  \"is_evaluation\": true,\n  \"score\": \"Band 7.0 or 3/3\",\n  \"feedback\": \"Detailed tutor feedback...\"\n}\n</evaluation>\nIf they are just asking a question about the task and not submitting an answer, do NOT include the `<evaluation>` block.";
        }

        if ($openAiKey) {
            try {
                $messages = [
                    ['role' => 'system', 'content' => $systemPrompt]
                ];

                foreach ($history as $chat) {
                    if (isset($chat['role']) && isset($chat['content'])) {
                        $messages[] = [
                            'role' => $chat['role'] === 'user' ? 'user' : 'assistant',
                            'content' => $chat['content']
                        ];
                    }
                }

                $messages[] = ['role' => 'user', 'content' => $message];

                $response = Http::withHeaders([
                    'Authorization' => 'Bearer ' . $openAiKey,
                    'Content-Type' => 'application/json',
                ])->post('https://api.openai.com/v1/chat/completions', [
                    'model' => 'gpt-4o-mini',
                    'messages' => $messages,
                    'temperature' => 0.7,
                ]);

                if ($response->successful()) {
                    $data = $response->json();
                    $reply = $data['choices'][0]['message']['content'] ?? null;
                    if ($reply) {
                        $attemptSaved = null;
                        if (str_contains($reply, '<evaluation>')) {
                            preg_match('/<evaluation>(.*?)<\/evaluation>/s', $reply, $matches);
                            if (!empty($matches[1])) {
                                $evalJson = json_decode(trim($matches[1]), true);
                                if ($evalJson && isset($evalJson['is_evaluation']) && $evalJson['is_evaluation']) {
                                    $attempt = \App\Models\AiPracticeAttempt::create([
                                        'user_id' => auth()->id(),
                                        'course_id' => session('active_course_id'),
                                        'skill' => $activeSkill,
                                        'question' => $activeQuestion,
                                        'user_answer' => $message,
                                        'score' => $evalJson['score'] ?? 'N/A',
                                        'feedback' => $evalJson['feedback'] ?? '',
                                    ]);
                                    $reply = preg_replace('/<evaluation>.*?<\/evaluation>/s', '', $reply);
                                    $attemptSaved = [
                                        'id' => $attempt->id,
                                        'skill' => ucfirst($attempt->skill),
                                        'score' => $attempt->score,
                                        'question' => $attempt->question,
                                        'user_answer' => $attempt->user_answer,
                                        'feedback' => $attempt->feedback,
                                        'date' => $attempt->created_at->format('d M Y, h:i A'),
                                    ];
                                    session()->forget(['active_practice_skill', 'active_practice_question']);
                                }
                            }
                        }

                        if (!$attemptSaved) {
                            $this->saveActivePracticeToSession($message, $reply);
                        }
                        return response()->json([
                            'reply' => $reply, 
                            'attempt' => $attemptSaved,
                            'active_skill' => session('active_practice_skill')
                        ]);
                    }
                }
            } catch (\Exception $e) {
                logger('OpenAI API Error: ' . $e->getMessage());
            }
        }

        if ($geminiKey) {
            try {
                $chatHistoryText = "";
                foreach ($history as $chat) {
                    $roleName = $chat['role'] === 'user' ? 'User' : 'Assistant';
                    $chatHistoryText .= $roleName . ": " . $chat['content'] . "\n\n";
                }
                $chatHistoryText .= "User: " . $message . "\n\nAssistant:";

                $geminiPrompt = $systemPrompt . "\n\nConversation History:\n" . $chatHistoryText;

                $response = Http::post('https://generativelanguage.googleapis.com/v1beta/models/gemini-1.5-flash:generateContent?key=' . $geminiKey, [
                    'contents' => [
                        [
                            'parts' => [
                                ['text' => $geminiPrompt]
                            ]
                        ]
                    ]
                ]);

                if ($response->successful()) {
                    $data = $response->json();
                    $reply = $data['candidates'][0]['content']['parts'][0]['text'] ?? null;
                    if ($reply) {
                        $attemptSaved = null;
                        if (str_contains($reply, '<evaluation>')) {
                            preg_match('/<evaluation>(.*?)<\/evaluation>/s', $reply, $matches);
                            if (!empty($matches[1])) {
                                $evalJson = json_decode(trim($matches[1]), true);
                                if ($evalJson && isset($evalJson['is_evaluation']) && $evalJson['is_evaluation']) {
                                    $attempt = \App\Models\AiPracticeAttempt::create([
                                        'user_id' => auth()->id(),
                                        'course_id' => session('active_course_id'),
                                        'skill' => $activeSkill,
                                        'question' => $activeQuestion,
                                        'user_answer' => $message,
                                        'score' => $evalJson['score'] ?? 'N/A',
                                        'feedback' => $evalJson['feedback'] ?? '',
                                    ]);
                                    $reply = preg_replace('/<evaluation>.*?<\/evaluation>/s', '', $reply);
                                    $attemptSaved = [
                                        'id' => $attempt->id,
                                        'skill' => ucfirst($attempt->skill),
                                        'score' => $attempt->score,
                                        'question' => $attempt->question,
                                        'user_answer' => $attempt->user_answer,
                                        'feedback' => $attempt->feedback,
                                        'date' => $attempt->created_at->format('d M Y, h:i A'),
                                    ];
                                    session()->forget(['active_practice_skill', 'active_practice_question']);
                                }
                            }
                        }

                        if (!$attemptSaved) {
                            $this->saveActivePracticeToSession($message, $reply);
                        }
                        return response()->json([
                            'reply' => $reply, 
                            'attempt' => $attemptSaved,
                            'active_skill' => session('active_practice_skill')
                        ]);
                    }
                }
            } catch (\Exception $e) {
                logger('Gemini API Error: ' . $e->getMessage());
            }
        }

        // Fallback response if no key is configured or requests fail
        $reply = $this->getFallbackResponse($message, $targetSkill, $customPrompt);

        $attemptSaved = null;
        if ($activeSkill && $activeQuestion) {
            $isAnswering = false;
            $userAnswerLower = strtolower($message);
            if ($activeSkill === 'reading' && (str_contains($userAnswerLower, 'true') || str_contains($userAnswerLower, 'false') || str_contains($userAnswerLower, 'not given'))) {
                $isAnswering = true;
            } elseif ($activeSkill === 'listening' && (str_contains($userAnswerLower, 'miller') || str_contains($userAnswerLower, 'lm-90231') || str_contains($userAnswerLower, 'a'))) {
                $isAnswering = true;
            } elseif ($activeSkill === 'writing' && str_word_count($message) > 20) {
                $isAnswering = true;
            } elseif ($activeSkill === 'speaking' && str_word_count($message) > 5) {
                $isAnswering = true;
            }

            if ($isAnswering) {
                $scoreAndFeedback = $this->getFallbackEvaluation($activeSkill, $activeQuestion, $message);
                $score = $scoreAndFeedback['score'];
                $feedback = $scoreAndFeedback['feedback'];
                $reply = "### 📊 Evaluation Result\n\n**Score:** {$score}\n\n{$feedback}";

                $attempt = \App\Models\AiPracticeAttempt::create([
                    'user_id' => auth()->id(),
                    'course_id' => session('active_course_id'),
                    'skill' => $activeSkill,
                    'question' => $activeQuestion,
                    'user_answer' => $message,
                    'score' => $score,
                    'feedback' => $feedback,
                ]);

                $attemptSaved = [
                    'id' => $attempt->id,
                    'skill' => ucfirst($attempt->skill),
                    'score' => $attempt->score,
                    'question' => $attempt->question,
                    'user_answer' => $attempt->user_answer,
                    'feedback' => $attempt->feedback,
                    'date' => $attempt->created_at->format('d M Y, h:i A'),
                ];

                session()->forget(['active_practice_skill', 'active_practice_question']);
            }
        }

        if (!$attemptSaved) {
            $this->saveActivePracticeToSession($message, $reply);
        }
        return response()->json([
            'reply' => $reply, 
            'attempt' => $attemptSaved,
            'active_skill' => session('active_practice_skill')
        ]);
    }

    // Helper to extract and save active practice skill & prompt to session
    private function saveActivePracticeToSession($message, &$reply)
    {
        $skill = null;
        $questionContent = null;

        // 1. Detect if the AI reply has a wrapped exercise
        if (preg_match('/<exercise skill="([^"]+)"\s*>(.*?)<\/exercise>/s', $reply, $matches)) {
            $skill = trim(strtolower($matches[1]));
            $questionContent = trim($matches[2]);

            // Strip the XML tags from the reply
            $reply = preg_replace('/<exercise skill="[^"]+">.*?<\/exercise>/s', $questionContent, $reply);
        }

        if ($skill) {
            $attempt = \App\Models\AiPracticeAttempt::create([
                'user_id' => auth()->id(),
                'course_id' => session('active_course_id'),
                'skill' => $skill,
                'question' => $questionContent,
                'user_answer' => '',
                'score' => 'Pending',
                'feedback' => 'Pending evaluation',
            ]);

            session([
                'active_practice_skill' => $skill,
                'active_practice_question' => $questionContent,
                'active_attempt_id' => $attempt->id
            ]);
        }
    }

    // Evaluate practice answer and persist to DB
    public function submitAnswer(Request $request)
    {
        $request->validate([
            'answer' => 'required|string',
        ]);

        $skill = session('active_practice_skill');
        $question = session('active_practice_question');
        $activeAttemptId = session('active_attempt_id');

        if (!$skill || !$question) {
            // Fallback: search for last pending practice attempt
            $lastPending = \App\Models\AiPracticeAttempt::where('user_id', auth()->id())
                ->where('score', 'Pending')
                ->latest()
                ->first();

            if ($lastPending) {
                $skill = $lastPending->skill;
                $question = $lastPending->question;
                $activeAttemptId = $lastPending->id;
                
                // Restore to session for consistency
                session([
                    'active_practice_skill' => $skill,
                    'active_practice_question' => $question,
                    'active_attempt_id' => $activeAttemptId
                ]);
            }
        }

        if (!$skill || !$question) {
            return response()->json([
                'error' => 'No active practice session found. Please request a practice prompt first.'
            ], 400);
        }

        $userAnswer = $request->input('answer');
        $openAiKey = env('OPENAI_API_KEY');
        $geminiKey = env('GEMINI_API_KEY');

        $score = 'N/A';
        $feedback = 'AI evaluation was not completed.';
        $evaluated = false;

        $prompt = "You are an expert examiner and tutor. Your task is to evaluate a student's answer to a practice task.

Here is the Practice Task / Question that was given:
---
{$question}
---

Here is the Student's Answer:
---
{$userAnswer}
---

Please evaluate the answer in English and provide:
1. A Score:
   - For Reading/Listening: Match against the correct answers and provide a score (e.g. '3/3' or '2/3').
   - For Writing/Speaking: Assess vocabulary, grammar, structure, coherence, and estimate a score (e.g. Band Score or X/Y).
2. Detailed Feedback: Highlight what they did well, point out any mistakes/errors with corrections, and provide suggestions for improvement.

Your response MUST be in the following strict JSON format:
{
  \"score\": \"Score or Band Score (e.g. '3/3' or 'Band 7.0')\",
  \"feedback\": \"Detailed feedback in markdown format\",
  \"reply\": \"Friendly response explaining the evaluation (in markdown format, including the score and feedback)\"
}";

        if ($openAiKey) {
            try {
                $response = Http::withHeaders([
                    'Authorization' => 'Bearer ' . $openAiKey,
                    'Content-Type' => 'application/json',
                ])->post('https://api.openai.com/v1/chat/completions', [
                    'model' => 'gpt-4o-mini',
                    'messages' => [
                        ['role' => 'user', 'content' => $prompt]
                    ],
                    'response_format' => ['type' => 'json_object'],
                    'temperature' => 0.5,
                ]);

                if ($response->successful()) {
                    $data = $response->json();
                    $content = json_decode($data['choices'][0]['message']['content'] ?? '{}', true);
                    if ($content) {
                        $score = $content['score'] ?? 'N/A';
                        $feedback = $content['feedback'] ?? '';
                        $reply = $content['reply'] ?? '';
                        $evaluated = true;
                    }
                }
            } catch (\Exception $e) {
                logger('OpenAI Evaluation Error: ' . $e->getMessage());
            }
        }

        if (!$evaluated && $geminiKey) {
            try {
                $response = Http::post('https://generativelanguage.googleapis.com/v1beta/models/gemini-1.5-flash:generateContent?key=' . $geminiKey, [
                    'contents' => [
                        [
                            'parts' => [
                                ['text' => $prompt . "\nNote: Ensure your output is a valid JSON object matching the requested schema."]
                            ]
                        ]
                    ],
                    'generationConfig' => [
                        'responseMimeType' => 'application/json'
                    ]
                ]);

                if ($response->successful()) {
                    $data = $response->json();
                    $text = $data['candidates'][0]['content']['parts'][0]['text'] ?? '{}';
                    $content = json_decode($text, true);
                    if ($content) {
                        $score = $content['score'] ?? 'N/A';
                        $feedback = $content['feedback'] ?? '';
                        $reply = $content['reply'] ?? '';
                        $evaluated = true;
                    }
                }
            } catch (\Exception $e) {
                logger('Gemini Evaluation Error: ' . $e->getMessage());
            }
        }

        // Fallback programmatic grading if AI keys are not configured or failed
        if (!$evaluated) {
            $scoreAndFeedback = $this->getFallbackEvaluation($skill, $question, $userAnswer);
            $score = $scoreAndFeedback['score'];
            $feedback = $scoreAndFeedback['feedback'];
            $reply = "### 📊 Évaluation\n\n**Score:** {$score}\n\n{$feedback}";
        }

        if (empty($reply)) {
            $reply = "### 📊 Evaluation\n\n**Score:** {$score}\n\n{$feedback}";
        }

        // Save attempt to database (Check active pending attempt from session)
        $activeAttemptId = session('active_attempt_id');
        $attempt = null;
        if ($activeAttemptId) {
            $attempt = \App\Models\AiPracticeAttempt::find($activeAttemptId);
        }

        if ($attempt) {
            $attempt->update([
                'course_id' => session('active_course_id') ?: $attempt->course_id,
                'user_answer' => $userAnswer,
                'score' => $score,
                'feedback' => $feedback,
            ]);
        } else {
            $attempt = \App\Models\AiPracticeAttempt::create([
                'user_id' => auth()->id(),
                'course_id' => session('active_course_id'),
                'skill' => $skill,
                'question' => $question,
                'user_answer' => $userAnswer,
                'score' => $score,
                'feedback' => $feedback,
            ]);
        }

        // Clear session so they have to request a new question before submitting again
        session()->forget(['active_practice_skill', 'active_practice_question', 'active_attempt_id']);

        return response()->json([
            'success' => true,
            'reply' => $reply,
            'attempt' => [
                'id' => $attempt->id,
                'skill' => ucfirst($attempt->skill),
                'score' => $attempt->score,
                'question' => $attempt->question,
                'user_answer' => $attempt->user_answer,
                'feedback' => $attempt->feedback,
                'date' => $attempt->created_at->format('d M Y, h:i A'),
            ]
        ]);
    }

    // Fallback grading method
    private function getFallbackEvaluation($skill, $question, $userAnswer)
    {
        $userAnswerLower = strtolower($userAnswer);
        
        if ($skill === 'reading' || $skill === 'listening') {
            $correctAnswers = $this->extractCorrectAnswersFromPrompt($question);
            
            $userAnswers = [];
            $lines = explode("\n", $userAnswer);
            foreach ($lines as $line) {
                $clean = trim(preg_replace('/^[\*\-\s]+/', '', $line));
                if (preg_match('/^(\d+)[\.\-\):]?\s*(.*)/i', $clean, $matches)) {
                    $num = (int)$matches[1];
                    $val = trim(strtolower($matches[2]));
                    
                    if (str_contains($val, 'vrai') || str_contains($val, 'true')) {
                        $val = 'true';
                    } elseif (str_contains($val, 'faux') || str_contains($val, 'false')) {
                        $val = 'false';
                    } elseif (str_contains($val, 'non mention') || str_contains($val, 'not given')) {
                        $val = 'not given';
                    } elseif (str_contains($val, 'yes') || $val === 'yes') {
                        $val = 'yes';
                    } elseif (str_contains($val, 'no') || $val === 'no') {
                        $val = 'no';
                    } else {
                        if (preg_match('/^([a-d])\b/i', $val, $letterMatch)) {
                            $val = strtolower($letterMatch[1]);
                        }
                    }
                    $userAnswers[$num] = $val;
                }
            }
            
            $totalQuestions = count($correctAnswers);
            $scoreCount = 0;
            $feedbackLines = [];
            
            if ($totalQuestions > 0) {
                foreach ($correctAnswers as $num => $correctVal) {
                    $userVal = $userAnswers[$num] ?? 'unanswered';
                    
                    $uClean = trim(preg_replace('/[\.,\-\*\'\"`\?]/', '', strtolower($userVal)));
                    $cClean = trim(preg_replace('/[\.,\-\*\'\"`\?]/', '', strtolower($correctVal)));
                    
                    $isCorrect = false;
                    if ($uClean === $cClean) {
                        $isCorrect = true;
                    } elseif (strlen($uClean) > 3 && strlen($cClean) > 3) {
                        if (str_contains($cClean, $uClean) || str_contains($uClean, $cClean)) {
                            $isCorrect = true;
                        }
                    }
                    
                    if ($isCorrect) {
                        $scoreCount++;
                        $feedbackLines[] = "- Question {$num}: **Correct** (Your answer: `{$userVal}`, Expected answer: `{$correctVal}`)";
                    } else {
                        $feedbackLines[] = "- Question {$num}: **Incorrect** (Your answer: `{$userVal}`, Expected answer: `{$correctVal}`)";
                    }
                }
                
                $feedbackStr = implode("\n", $feedbackLines);
                return [
                    'score' => "{$scoreCount}/{$totalQuestions}",
                    'feedback' => "### Evaluation Results:\n{$feedbackStr}\n\n**Final Score: {$scoreCount}/{$totalQuestions}**"
                ];
            } else {
                if ($skill === 'listening') {
                    $scoreCount = 0;
                    if (str_contains($userAnswerLower, 'miller')) $scoreCount++;
                    if (str_contains($userAnswerLower, 'lm-90231') || str_contains($userAnswerLower, 'lm90231')) $scoreCount++;
                    if (str_contains($userAnswerLower, 'a') && (str_contains($userAnswerLower, '3. a') || str_contains($userAnswerLower, '3.a') || str_contains($userAnswerLower, 'room a') || str_contains($userAnswerLower, 'room. a'))) $scoreCount++;
                    if (str_contains($userAnswerLower, 'presentation')) $scoreCount++;
                    if (str_contains($userAnswerLower, '5:00') || str_contains($userAnswerLower, '5 pm') || str_contains($userAnswerLower, '5pm')) $scoreCount++;
                    if (str_contains($userAnswerLower, '7:00') || str_contains($userAnswerLower, '7 pm') || str_contains($userAnswerLower, '7pm')) $scoreCount++;
                    if (str_contains($userAnswerLower, '10') || str_contains($userAnswerLower, 'ten')) $scoreCount++;
                    if (str_contains($userAnswerLower, 'credit card') || str_contains($userAnswerLower, 'card')) $scoreCount++;
                    if (str_contains($userAnswerLower, 'bottled')) $scoreCount++;
                    if (str_contains($userAnswerLower, 'sr-452') || str_contains($userAnswerLower, 'sr452')) $scoreCount++;
                    return [
                        'score' => "{$scoreCount}/10",
                        'feedback' => "Based on our automatic evaluation key:\n- Question 1: **Miller**\n- Question 2: **LM-90231**\n- Question 3: **A**\n- Question 4: **presentation**\n- Question 5: **5:00**\n- Question 6: **7:00**\n- Question 7: **10**\n- Question 8: **credit card**\n- Question 9: **bottled**\n- Question 10: **SR-452**\n\nYour score: **{$scoreCount}/10**"
                    ];
                } else {
                    $scoreCount = 0;
                    if (preg_match('/1\.\s*(true|vrai)/i', $userAnswerLower)) $scoreCount++;
                    if (preg_match('/2\.\s*(true|vrai)/i', $userAnswerLower)) $scoreCount++;
                    if (preg_match('/3\.\s*(not given|non mention)/i', $userAnswerLower)) $scoreCount++;
                    if (preg_match('/4\.\s*(true|vrai)/i', $userAnswerLower)) $scoreCount++;
                    if (preg_match('/5\.\s*(false|faux)/i', $userAnswerLower)) $scoreCount++;
                    if (preg_match('/6\.\s*(false|faux)/i', $userAnswerLower)) $scoreCount++;
                    if (preg_match('/7\.\s*(false|faux)/i', $userAnswerLower)) $scoreCount++;
                    if (preg_match('/8\.\s*(true|vrai)/i', $userAnswerLower)) $scoreCount++;
                    if (preg_match('/9\.\s*(true|vrai)/i', $userAnswerLower)) $scoreCount++;
                    if (preg_match('/10\.\s*(not given|non mention)/i', $userAnswerLower)) $scoreCount++;
                    return [
                        'score' => "{$scoreCount}/10",
                        'feedback' => "Based on our automatic evaluation key:\n- Question 1: **True**\n- Question 2: **True**\n- Question 3: **Not Given**\n- Question 4: **True**\n- Question 5: **False**\n- Question 6: **False**\n- Question 7: **False**\n- Question 8: **True**\n- Question 9: **True**\n- Question 10: **Not Given**\n\nYour score: **{$scoreCount}/10**"
                    ];
                }
            }
        }
        
        if ($skill === 'writing') {
            $wordCount = str_word_count($userAnswer);
            $band = "Score: 12/20";
            if ($wordCount > 250) {
                $band = "Score: 16/20";
            } elseif ($wordCount > 180) {
                $band = "Score: 14/20";
            } else {
                $band = "Score: 10/20";
            }
            
            return [
                'score' => $band,
                'feedback' => "Your essay contains approximately **{$wordCount} words**. To improve your score, ensure you use formal vocabulary, clear transitional phrases, and structure your paragraphs logically."
            ];
        }
        
        if ($skill === 'speaking') {
            return [
                'score' => "Score: 13/20",
                'feedback' => "This is an oral speaking practice. Focus on organizing your ideas, speaking clearly, and maintaining a steady pace to increase your fluency."
            ];
        }
        
        return [
            'score' => 'N/A',
            'feedback' => 'Evaluation completed.'
        ];
    }

    private function extractCorrectAnswersFromPrompt($text)
    {
        $answers = [];
        $lowerText = strtolower($text);
        
        $keywords = ['réponses', 'corrigé', 'solution', 'correction', 'answers', 'answer key', 'explications'];
        $index = -1;
        foreach ($keywords as $kw) {
            $pos = strrpos($lowerText, $kw);
            if ($pos !== false && $pos > $index) {
                $index = $pos;
            }
        }
        
        if ($index === -1) {
            $index = (int)(strlen($text) * 0.6);
        }
        
        $answerPart = substr($text, $index);
        $lines = explode("\n", $answerPart);
        
        $count = 1;
        foreach ($lines as $line) {
            $clean = trim(preg_replace('/^[\*\-\s]+/', '', $line));
            if (preg_match('/^(?:q)?(\d+)[\.\-\):]?\s*(.*)/i', $clean, $matches)) {
                $num = (int)$matches[1];
                $rest = trim(strtolower($matches[2]));
                
                // Clean leading punctuation/markdown
                $rest = ltrim($rest, "*:-.)( \t");
                
                $val = '';
                
                $idxTrue = strpos($rest, 'true');
                if ($idxTrue === false) $idxTrue = strpos($rest, 'vrai');
                
                $idxFalse = strpos($rest, 'false');
                if ($idxFalse === false) $idxFalse = strpos($rest, 'faux');
                
                $idxNotGiven = strpos($rest, 'not given');
                if ($idxNotGiven === false) $idxNotGiven = strpos($rest, 'non mention');
                if ($idxNotGiven === false) $idxNotGiven = strpos($rest, 'non-mention');
                
                $idxMC = false;
                $mcVal = '';
                if (preg_match('/\b([a-d])\b/', $rest, $mcMatch, PREG_OFFSET_CAPTURE)) {
                    $idxMC = $mcMatch[1][1];
                    $mcVal = strtolower($mcMatch[1][0]);
                }
                
                $minIdx = INF;
                
                if ($idxTrue !== false && $idxTrue < $minIdx) {
                    $minIdx = $idxTrue;
                    $val = 'true';
                }
                if ($idxFalse !== false && $idxFalse < $minIdx) {
                    $minIdx = $idxFalse;
                    $val = 'false';
                }
                if ($idxNotGiven !== false && $idxNotGiven < $minIdx) {
                    $minIdx = $idxNotGiven;
                    $val = 'not given';
                }
                if ($idxMC !== false && $idxMC < $minIdx) {
                    $minIdx = $idxMC;
                    $val = $mcVal;
                }
                
                if ($val) {
                    $answers[$count] = $val;
                    $count++;
                }
            }
        }
        
        return $answers;
    }

    private function getModulePrompt($targetSkill = null, $activeCourseId = null)
    {
        if ($targetSkill) {
            $targetSkill = strtolower($targetSkill);

            // 1. Check Prompt model for activeCourseId + skill
            if ($activeCourseId) {
                $prompt = \App\Models\Prompt::where('course_id', $activeCourseId)
                    ->where('skill', $targetSkill)
                    ->where('status', true)
                    ->latest()
                    ->value('prompt_text');
                if ($prompt) return $prompt;
            }

            // 2. Check Course custom_prompt JSON for activeCourseId
            if ($activeCourseId) {
                $courseObj = Course::find($activeCourseId);
                if ($courseObj && $courseObj->has_custom_prompt && $courseObj->custom_prompt) {
                    $dec = json_decode($courseObj->custom_prompt, true);
                    if (json_last_error() === JSON_ERROR_NONE && is_array($dec) && !empty($dec[$targetSkill])) {
                        return $dec[$targetSkill];
                    }
                }
            }

            // 3. Fallback: Check Prompt model for any active prompt for this skill
            $p = \App\Models\Prompt::where('skill', $targetSkill)->where('status', true)->latest()->value('prompt_text');
            if ($p) return $p;

            // 4. Fallback: Check ANY published Course custom_prompt JSON for this skill
            $coursesWithPrompt = Course::where('status', 'published')
                ->where('has_custom_prompt', true)
                ->whereNotNull('custom_prompt')
                ->latest()
                ->get();
            foreach ($coursesWithPrompt as $cObj) {
                $dec = json_decode($cObj->custom_prompt, true);
                if (json_last_error() === JSON_ERROR_NONE && is_array($dec) && !empty($dec[$targetSkill])) {
                    return $dec[$targetSkill];
                }
            }

            return null;
        }

        // If no target skill specified, aggregate all active module prompts
        $skillsPrompts = [];
        foreach (['reading', 'listening', 'speaking', 'writing'] as $s) {
            $p = $this->getModulePrompt($s, $activeCourseId);
            if ($p) {
                $skillsPrompts[] = "- " . ucfirst($s) . " Module Admin Prompt:\n" . $p;
            }
        }

        return !empty($skillsPrompts) ? implode("\n\n", $skillsPrompts) : null;
    }

    private function getFallbackResponse($message, $targetSkill = null, $customPrompt = null)
    {
        if ($targetSkill && $customPrompt) {
            if (preg_match('/<exercise skill="[^"]+">.*?<\/exercise>/s', $customPrompt)) {
                return $customPrompt;
            }

            $skillEmoji = [
                'reading' => '📖',
                'listening' => '🎧',
                'writing' => '✍️',
                'speaking' => '🗣️'
            ][$targetSkill] ?? '📝';

            $formattedContent = $customPrompt;
            $hasAnswerKey = str_contains(strtolower($customPrompt), 'answer key') 
                || str_contains(strtolower($customPrompt), 'answers') 
                || str_contains(strtolower($customPrompt), 'corrigé') 
                || str_contains(strtolower($customPrompt), 'réponses');

            if (!$hasAnswerKey && ($targetSkill === 'reading' || $targetSkill === 'listening')) {
                $formattedContent .= "\n\n### Answer Key\n1. Correct Answer - Reference admin guidelines.";
            }

            return "<exercise skill=\"{$targetSkill}\">\n### {$skillEmoji} " . ucfirst($targetSkill) . " Practice (Admin Prompt)\n\n{$formattedContent}\n</exercise>";
        }
         // Speaking / Cue Card
        if (str_contains($message, 'cue') || str_contains($message, 'speaking') || str_contains($message, 'talk') || str_contains($message, 'speak') || str_contains($message, 'orale') || str_contains($message, 'parler')) {
            return "<exercise skill=\"speaking\">### 🗣️ Speaking Practice: Cue Card Topic\n\n**Topic:**\nDescribe a beautiful place you have visited in your country.\n\n*You should say:*\n* Where this place is located\n* When you went there\n* Whom you went with\n* And explain why you find this place so beautiful.\n\n---\n\n### 💡 Practice Tips:\n1. Take **1 minute** to prepare your notes in writing.\n2. Talk continuously for **1 to 2 minutes** on this topic.\n3. Record your voice to check your fluency, pronunciation, and grammatical accuracy.\n\n---\n\n### ❓ Follow-up Questions (Part 3):\n* Why do people like to travel to beautiful places?\n* Do you think tourist sites are well protected in your country?\n* How can local communities benefit from tourism?</exercise>";
        }
        
        // Reading
        if (str_contains($message, 'reading') || str_contains($message, 'passage') || str_contains($message, 'read') || str_contains($message, 'écrite') || str_contains($message, 'lecture')) {
            return "<exercise skill=\"reading\">### 📖 Reading Comprehension: Passage and Questions

**Text: The Rise of Online Learning (E-Learning)**
The digital revolution has transformed education worldwide. Online learning, or e-learning, refers to instruction facilitated by digital technologies. While traditional classrooms rely on physical presence and printed textbooks, e-learning allows students to access resources from anywhere in the world and at any time.

Proponents of online learning argue that its primary benefit is flexibility. Students can learn at their own pace, which is ideal for working professionals. Furthermore, educational platforms offer a wider variety of courses than physical schools. However, critics point out that online learning requires a high degree of self-discipline. Without the structure of a classroom, many students struggle to complete their courses. In addition, the lack of face-to-face interaction can lead to feelings of isolation.

#### 📝 Questions 1-10 (True / False / Not Given)
*Determine if the following statements agree with the text:*

1. **Traditional classrooms rely on physical presence.** (True/False/Not Given)
2. **E-learning allows resource access from anywhere at any time.** (True/False/Not Given)
3. **E-learning has completely replaced traditional universities.** (True/False/Not Given)
4. **Flexibility is considered a main advantage of online learning.** (True/False/Not Given)
5. **Only working professionals can benefit from learning at their own pace.** (True/False/Not Given)
6. **Physical schools offer a wider variety of courses than e-learning platforms.** (True/False/Not Given)
7. **Online learning does not require any self-discipline.** (True/False/Not Given)
8. **Without classroom structure, many students fail to complete online courses.** (True/False/Not Given)
9. **The lack of face-to-face interaction can cause feelings of isolation.** (True/False/Not Given)
10. **Students find online exams harder than traditional ones.** (True/False/Not Given)

---

### Answer Key
1. True
2. True
3. Not Given
4. True
5. False
6. False
7. False
8. True
9. True
10. Not Given</exercise>";
        }
        
        // Listening
        if (str_contains($message, 'listening') || str_contains($message, 'listen') || str_contains($message, 'audio') || str_contains($message, 'orale') || str_contains($message, 'écoute')) {
            return "<exercise skill=\"listening\">### 🎧 Listening Comprehension: Transcript and Questions

**Transcript: Booking a Study Room at the Library**
*Librarian:* Hello, welcome to the city library services. How can I help you?
*Student:* Hello, I would like to reserve a private study room for tomorrow evening, please.
*Librarian:* Sure. May I have your full name and library card number?
*Student:* Yes, my name is John Miller, and my card number is **LM-90231**.
*Librarian:* Thank you. We have two rooms available tomorrow: Room A, which has a projector, and Room B, which is a quiet study room with a computer.
*Student:* The room with a projector (Room A) would be perfect, as I need to practice for a presentation. I will need it from 5:00 PM to 7:00 PM.
*Librarian:* Great. That will be for two hours. The reservation fee is ten dollars per hour, so it will be a total of twenty dollars.
*Student:* That is fine. Do I pay now or tomorrow?
*Librarian:* You need to pay now to secure the slot. We accept cash, credit cards, or mobile pay.
*Student:* I will pay with my credit card.
*Librarian:* Excellent. Also, please remember that no food is allowed inside the study rooms, but you may bring bottled water.
*Student:* Got it. Thank you for your help.
*Librarian:* You are welcome. Your reservation code is **SR-452**. See you tomorrow, John!

#### 📝 Questions 1-10 (Complete the Information)
*Complete the details below using **NO MORE THAN TWO WORDS AND/OR A NUMBER** :*

1. The student's last name is John **__________**.
2. The student's library card number is **__________**.
3. The student wants to book Room **__________** because it has a projector.
4. The student wants to practice for a **__________**.
5. The booking time starts at **__________** PM.
6. The booking time ends at **__________** PM.
7. The reservation fee is **__________** dollars per hour.
8. The student pays for the booking using a **__________**.
9. The only drink allowed in the study room is **__________** water.
10. The student's reservation code is **__________**.

---

### Answer Key
1. Miller
2. LM-90231
3. A
4. presentation
5. 5:00
6. 7:00
7. 10
8. credit card
9. bottled
10. SR-452</exercise>";
        }
        
        if (str_contains($message, 'writing') || str_contains($message, 'essay') || str_contains($message, 'write') || str_contains($message, 'écrite') || str_contains($message, 'rédaction')) {
            return "<exercise skill=\"writing\">### ✍️ Writing Practice: Essay Topic\n\n**Topic:**\n*Some people believe that university education should be free for all students. Others disagree, arguing that students should pay for their own higher education.*\n*Discuss both views and give your opinion.*\n\n---\n\n### 🏛️ Suggested Structure:\n1. **Introduction**: Rephrase the topic + present your thesis (your clear opinion).\n2. **Body Paragraph 1**: Present the first view (Why university should be free, e.g. equal opportunity, skilled workforce).\n3. **Body Paragraph 2**: Present the second view (Why students should pay, e.g. state budget limits, higher student responsibility).\n4. **Conclusion**: Summarize main points and restate your opinion.\n\n**💡 Tip:** Write at least **250 words** in **40 minutes**. If you write your essay here, I will evaluate it for you!</exercise>";
        }
        
        // General Response
        return "Hello! I am your **FrancoWay AI Study Partner**.\n\nI can help you practice and improve your language skills in four key modules. Please choose what you would like to practice:\n\n* 📖 **Reading Comprehension**: Ask me for a reading passage and questions.\n* 🎧 **Listening Comprehension**: Ask me for a listening transcript and questions.\n* ✍️ **Writing Practice**: Ask me for an essay prompt.\n* 🗣️ **Speaking Practice**: Ask me for an oral discussion topic.\n\n*Simply type what you want to practice (e.g., 'give me a reading passage') or click on one of the quick action buttons to begin!*";
    }

    // PRIVACY POLICY PAGE
    public function privacyPolicy()
    {
        $settings = Setting::pluck('value', 'key')->toArray();
        return view('privacy-policy', compact('settings'));
    }

    // TERMS & CONDITIONS PAGE
    public function termsConditions()
    {
        $settings = Setting::pluck('value', 'key')->toArray();
        return view('terms-conditions', compact('settings'));
    }
}

