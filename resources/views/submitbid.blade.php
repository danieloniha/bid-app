<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Submit Your Bid</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/submitbid.css') }}">
</head>

<body>
    {{-- Sidebar --}}
    <nav class="sidebar">
        <div class="logo">

            <span class="logo-text">Vertiqal</span>
        </div>

        <div class="nav-section">
            <div class="nav-title">Main</div>
            <a href="#" class="nav-item">
                <i class="fas fa-th-large"></i>
                Dashboard
            </a>
            <a href="#" class="nav-item">
                <i class="fas fa-file-contract"></i>
                Tenders
            </a>
            <a href="#" class="nav-item active">
                <i class="fas fa-gavel"></i>
                Bids
            </a>
        </div>

        <div class="user-profile">
            <div class="user-avatar">JD</div>
            <div class="user-info">
                <h4>John Doe</h4>
                <span>johndoe12@gmail.com</span>
            </div>
        </div>
    </nav>

    {{-- Main Content --}}
    <main class="main-content">
        {{-- Header --}}
        <header class="content-header">
            <h1 class="header-title">Submit Your Bid</h1>
            <p class="header-subtitle">Provide your quotation details, delivery terms, and supporting documents for this
                tender.</p>
        </header>

        {{-- Form --}}
        <div class="form-container">
            <form id="" action="{{ route('bids.store') }}" method="POST" enctype="multipart/form-data">
                @csrf

                {{-- Enter Your Offer Section --}}
                <div class="form-section">
                    <h2 class="section-title">Enter Your Offer</h2>

                    {{-- Tender Information --}}
                    <h3 style="font-size: 16px; font-weight: 600; color: #374151; margin-bottom: 20px;">Tender
                        Information</h3>

                    <div class="form-grid">
                        <div class="form-group">
                            <label class="form-label">Tender Title</label>
                            <input type="text" class="form-input" name="tender_title" value="7 tons"
                                placeholder="Enter tender title" value="{{ old('tender_title') }}">
                            @error('tender_title')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label class="form-label">Buyer</label>
                            <input type="text" class="form-input" name="buyer_name" placeholder="Enter buyer name"
                                value="{{ old('buyer_name') }}">
                        </div>

                        <div class="form-group">
                            <label class="form-label">Tender ID</label>
                            <input type="text" class="form-input" name="tender_id" value="TNDR-2025-004"
                                placeholder="Enter tender ID" value="{{ old('tender_id') }}">
                        </div>

                        <div class="form-group">
                            <label class="form-label">Categories</label>
                            <select class="form-select" name="category_id">
                                <option value="">Select Category</option>
                                @foreach ($categories as $category)
                                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group">
                            <label class="form-label">Delivery Location</label>
                            <select class="form-select" name="delivery_location" value="{{ old('delivery_location') }}">
                                <option value="">Select Location</option>
                                <option value="lagos">Lagos</option>
                                <option value="abuja">Abuja</option>
                                <option value="kano">Kano</option>
                                <option value="port-harcourt">Port Harcourt</option>
                                <option value="ibadan">Ibadan</option>
                            </select>
                        </div>

                        <div class="form-group">
                            <label class="form-label">Unit Price</label>
                            <div class="currency-input">
                                <span class="currency-symbol">₦</span>
                                <input type="number" class="form-input" name="unit_price" placeholder="2000"
                                    min="0" step="0.01" value="{{ old('unit_price') }}">
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="form-label">Delivery Date</label>
                            <select class="form-select" name="delivery_date">
                                <option value="">Select Date</option>
                                <option value="within-7-days">Within 7 days</option>
                                <option value="within-14-days">Within 14 days</option>
                                <option value="within-30-days">Within 30 days</option>
                            </select>
                        </div>

                        <div class="form-group">
                            <label class="form-label">Available quantity you can supply</label>
                            <div class="currency-input">
                                <span class="currency-symbol">₦</span>
                                <input type="number" class="form-input" name="quantity" placeholder="2000"
                                    min="0" step="0.01" value="{{ old('quantity') }}">
                            </div>
                        </div>
                    </div>

                    {{-- Documents Section --}}
                    <div class="form-group full-width" style="margin-top: 30px;">
                        <label class="form-label">Upload supporting documents, business certificate, product
                            photo</label>
                        <div class="file-upload-area" onclick="document.getElementById('fileInput').click()">
                            <div class="upload-icon">
                                <i class="fas fa-cloud-upload-alt"></i>
                            </div>
                            <div class="upload-text">Upload product images (Max 3)</div>
                            <div class="upload-subtext">PNG, JPG up to 5MB each</div>
                            <button type="button" class="choose-files-btn">Choose Files</button>
                        </div>
                        <input type="file" id="fileInput" class="file-input" name="document[]" multiple
                            accept=".png,.jpg,.jpeg,.pdf,.doc,.docx">
                    </div>

                    {{-- Note to Buyer --}}
                    <div class="form-group full-width" style="margin-top: 25px;">
                        <label class="form-label">Note to Buyer</label>
                        <textarea class="form-textarea" name="note"
                            placeholder="Add any additional information or special terms for the buyer...">{{ old('note') }}</textarea>
                    </div>

                    {{-- Checkboxes --}}
                    <div class="checkbox-group">
                        <div class="checkbox-item">
                            <input type="checkbox" id="specifications" class="checkbox-input"
                                name="confirm_specifications" required>
                            <label for="specifications" class="checkbox-label">I confirm that my offer meets all
                                specifications provided</label>
                        </div>

                        <div class="checkbox-item">
                            <input type="checkbox" id="terms" class="checkbox-input" name="agree_terms"
                                required>
                            <label for="terms" class="checkbox-label">I agree to abide by the buyer's procurement
                                terms</label>
                        </div>
                    </div>

                    {{-- Form Actions --}}
                    <div class="form-actions">
                        <button type="button" class="btn btn-secondary">Cancel</button>
                        <button type="submit" class="btn btn-primary">Submit Bid</button>
                    </div>
                </div>
            </form>
        </div>
    </main>

    <script>
        const fileInput = document.getElementById('fileInput');
        const uploadArea = document.querySelector('.file-upload-area');

        fileInput.addEventListener('change', e => {
            const files = e.target.files;
            const fileCount = files.length;
            const uploadText = uploadArea.querySelector('.upload-text');
            const uploadSubtext = uploadArea.querySelector('.upload-subtext');

            if (fileCount === 1) {
                uploadText.textContent = `1 file selected: ${files[0].name}`;
            } else if (fileCount > 1) {
                uploadText.textContent = `${fileCount} files selected`;
            } else {
                uploadText.textContent = 'Upload product images (Max 3)';
            }

            uploadSubtext.textContent = 'Files ready for upload';
        });
    </script>
</body>

</html>
