# 3-Step Wizard Implementation for Permohonan Create

## Overview
Convert the single-form permohonan creation into a 3-step wizard:
1. Step 1: User Data Validation (from users table)
2. Step 2: Permohonan Data Validation (from permohonan table)
3. Step 3: Peminjaman Data Validation (from peminjaman table)

## Implementation Steps

### Phase 1: Routes and Controller Setup
- [ ] Update routes/web.php - Add wizard routes
- [ ] Update PermohonanController.php - Add wizard methods
- [ ] Create session-based data storage

### Phase 2: Blade Views Creation
- [ ] Create resources/views/permohonan/step1.blade.php
- [ ] Create resources/views/permohonan/step2.blade.php
- [ ] Create resources/views/permohonan/step3.blade.php
- [ ] Update resources/views/permohonan/create.blade.php (wizard container)

### Phase 3: Form Validation and Processing
- [ ] Implement step-by-step validation
- [ ] Add session data persistence
- [ ] Create final submission logic

### Phase 4: JavaScript and UI Enhancement
- [ ] Add progress indicator
- [ ] Implement step navigation
- [ ] Add form validation feedback
- [ ] Dynamic cost calculation

### Phase 5: Testing and Refinement
- [ ] Test each step individually
- [ ] Test navigation between steps
- [ ] Test session persistence
- [ ] Test final submission
- [ ] Handle edge cases and errors

## Current Status
- [x] Plan created and approved
- [ ] Implementation started
