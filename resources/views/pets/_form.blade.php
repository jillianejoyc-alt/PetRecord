@if ($errors->any())
    <div class="alert alert-danger" role="alert"><strong>Please correct the following:</strong><ul class="mb-0 mt-1">@foreach ($errors->all() as $error)<li>{{ $error }}</li>@endforeach</ul></div>
@endif
<div class="form-section-title">Pet information</div>
<div class="row g-3">
    <div class="col-md-6"><label class="form-label" for="name">Pet name <span class="required-mark">*</span></label><input class="form-control" id="name" name="name" value="{{ old('name', $pet->name) }}" maxlength="100" required></div>
    <div class="col-md-3"><label class="form-label" for="type">Pet type <span class="required-mark">*</span></label><select class="form-select" id="type" name="type" required><option value="">Select type</option>@foreach (['Dog', 'Cat', 'Other'] as $type)<option value="{{ $type }}" @selected(old('type', $pet->type) === $type)>{{ $type }}</option>@endforeach</select></div>
    <div class="col-md-3"><label class="form-label" for="breed">Breed</label><input class="form-control" id="breed" name="breed" value="{{ old('breed', $pet->breed) }}" maxlength="100" placeholder="Optional"></div>
    <div class="col-md-3"><label class="form-label" for="age">Age (years) <span class="required-mark">*</span></label><input class="form-control" id="age" name="age" type="number" min="0" max="200" value="{{ old('age', $pet->age) }}" required></div>
    <div class="col-md-3"><label class="form-label" for="gender">Gender <span class="required-mark">*</span></label><select class="form-select" id="gender" name="gender" required><option value="">Select gender</option>@foreach (['Male', 'Female'] as $gender)<option value="{{ $gender }}" @selected(old('gender', $pet->gender) === $gender)>{{ $gender }}</option>@endforeach</select></div>
    <div class="col-md-3"><label class="form-label" for="date_registered">Date registered <span class="required-mark">*</span></label><input class="form-control" id="date_registered" name="date_registered" type="date" value="{{ old('date_registered', $pet->date_registered?->format('Y-m-d')) }}" required></div>
</div>
<div class="form-section-title owner-section-title">Owner information</div>
<div class="row g-3">
    <div class="col-md-6"><label class="form-label" for="owner_name">Owner name <span class="required-mark">*</span></label><input class="form-control" id="owner_name" name="owner_name" value="{{ old('owner_name', $pet->owner_name) }}" maxlength="120" required></div>
    <div class="col-md-6"><label class="form-label" for="contact_number">Contact number <span class="required-mark">*</span></label><input class="form-control" id="contact_number" name="contact_number" type="tel" value="{{ old('contact_number', $pet->contact_number) }}" maxlength="30" required></div>
    <div class="col-12"><label class="form-label" for="address">Address <span class="required-mark">*</span></label><textarea class="form-control" id="address" name="address" rows="3" maxlength="2000" required>{{ old('address', $pet->address) }}</textarea></div>
</div>
<div class="form-actions">
    <a class="btn btn-light" href="{{ isset($editing) && $editing ? route('pets.show', $pet) : route('pets.index') }}">Cancel</a>
    <button class="btn btn-primary" type="submit">{{ isset($editing) && $editing ? 'Save changes' : 'Save pet record' }}</button>
</div>