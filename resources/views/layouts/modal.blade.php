<!-- Partial: Global Apply Modal -->
<div class="modal fade" id="ModalApplyJobForm" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content apply-job-form">
      <button class="btn-close m-3" type="button" data-bs-dismiss="modal" aria-label="Close"></button>

      <div class="modal-body px-4 pt-4">
        <div class="text-center mb-3">
          <p class="font-sm text-muted">Job Application</p>
          <h4 id="apply_modal_job_title" class="mb-1 text-capitalize">Apply for Job</h4>
          <p class="font-sm text-muted">Please fill in your information and send it to the employer.</p>
        </div>

        {{-- Success flash shown above modal (or you can show inside modal) --}}
        @if (session('success'))
          <div class="alert alert-success">
            {{ session('success') }}
            @if (session('guest_token'))
              <div class="small mt-1">Your application code: <strong>{{ session('guest_token') }}</strong></div>
            @endif
          </div>
        @endif

        <form id="applyJobForm" action="{{ route('apply.job') }}" method="POST" enctype="multipart/form-data"
          class="login-register">

          @csrf

          <!-- GLOBAL JOB ID -->
          <input type="hidden" name="job_id" id="apply_job_id" value="{{ old('job_id') }}">

          {{-- Full name --}}
          <div class="mb-3">
            <label class="form-label" for="full_name">Full Name *</label>
            <input class="form-control @error('full_name') is-invalid @enderror" id="full_name" name="full_name"
              type="text" required minlength="4" pattern="^\S+(\s+\S+)+" title="Please enter first and last name"
              value="{{ old('full_name') }}" placeholder="Steven Job">
            @error('full_name')
              <div class="invalid-feedback">{{ $message }}</div>
            @enderror
          </div>

          {{-- Email --}}
          <div class="mb-3">
            <label class="form-label" for="email">Email *</label>
            <input class="form-control @error('email') is-invalid @enderror" id="email" name="email"
              type="email" required value="{{ old('email') }}" placeholder="stevenjob@gmail.com">
            @error('email')
              <div class="invalid-feedback">{{ $message }}</div>
            @enderror
          </div>

          {{-- Phone --}}
          <div class="mb-3">
            <label class="form-label" for="phone">Contact Number *</label>
            <input class="form-control @error('phone') is-invalid @enderror" id="phone" name="phone"
              type="text" required maxlength="20" value="{{ old('phone') }}" placeholder="(+01) 234 567 89">
            @error('phone')
              <div class="invalid-feedback">{{ $message }}</div>
            @enderror
          </div>

          {{-- Description --}}
          <div class="mb-3">
            <label class="form-label" for="description">Description</label>
            <textarea class="form-control @error('description') is-invalid @enderror" id="description" name="description"
              rows="3" placeholder="Your description...">{{ old('description') }}</textarea>
            @error('description')
              <div class="invalid-feedback">{{ $message }}</div>
            @enderror
          </div>

          {{-- Resume --}}
          <div class="mb-3">
            <label class="form-label" for="resume">Upload Resume</label>
            <input class="form-control @error('resume') is-invalid @enderror" id="resume" name="resume"
              type="file" accept=".pdf,.doc,.docx">
            @error('resume')
              <div class="invalid-feedback">{{ $message }}</div>
            @enderror
          </div>

          {{-- Duplicate / custom errors --}}
          @if ($errors->has('duplicate'))
            <div class="alert alert-warning">{{ $errors->first('duplicate') }}</div>
          @endif

          <div class="mb-3">
            <div class="form-check mb-2">
              <input class="form-check-input" type="checkbox" id="terms" required>
              <label class="form-check-label small" for="terms">Agree our terms and policy</label>
            </div>
            <button class="btn btn-primary w-100" type="submit">Apply Job</button>
          </div>

        </form>
      </div>
    </div>
  </div>
</div>
