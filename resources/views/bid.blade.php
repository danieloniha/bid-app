<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bid Management</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/bidstyle1.css') }}">
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
            <a href="{{ route('bids') }}" class="nav-item active">
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

        <div style="padding: 0 8px 20px;">
            <a href="#" class="nav-item" style="margin: 0; color: rgba(255,255,255,0.8);">
                <i class="fas fa-sign-out-alt"></i>
                Log Out
            </a>
        </div>
    </nav>

    {{-- Main Content --}}
    <main class="main-content">
        {{-- Header --}}
        <header class="content-header">
            <div class="header-top">
                <div>
                    <h1 class="header-title">Bid Management</h1>
                    <p class="header-subtitle">Monitor your bid submissions and track their progress</p>
                </div>
                <a href="{{ route('bids.create') }}"><button class="add-btn">
                        <i class="fas fa-plus"></i>
                        Add New Bids
                    </button></a>
            </div>

            {{-- Tabs --}}
            <div class="tabs">
                <button class="tab active">All Bids</button>
                <button class="tab">Submitted</button>
                <button class="tab">Under Review</button>
                <button class="tab">Accepted</button>
                <button class="tab">Rejected</button>
            </div>
        </header>

        {{-- Filters --}}
        <div class="filters">
            <div class="search-box">
                <i class="fas fa-search"></i>
                <input type="text" placeholder="Search the tender title and buyer's name...">
            </div>
            <select class="filter-dropdown">
                <option>Status</option>
                <option>Under Review</option>
                <option>Accepted</option>
                <option>Rejected</option>
            </select>
            <select class="filter-dropdown" id="categoryFilter">
                <option>Category</option>
                @foreach ($categories as $category)
                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                @endforeach
            </select>
            <select class="filter-dropdown">
                <option>Location</option>
                <option>Kano</option>
                <option>Lagos</option>
                <option>Abuja</option>
            </select>
            <select class="filter-dropdown">
                <option>Date Range</option>
                <option>Last 30 days</option>
                <option>Last 90 days</option>
            </select>
        </div>

        {{-- Table --}}
        <div class="table-container">
            <table class="bids-table" id="bidsTable">
                <thead>
                    <tr>
                        <th>Tender Title</th>
                        <th>Buyer</th>
                        <th>Category</th>
                        <th>Bid Amount</th>
                        <th>Location</th>
                        <th>Status</th>
                        <th>Submitted On</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($bids as $bid)
                        <tr data-status="{{ strtolower($bid->status) }}">
                            <td class="tender-title">{{ $bid->tender_title }}</td>
                            <td class="buyer-name">{{ $bid->buyer_name }}</td>
                            <td class="category">{{ $bid->category->name }}</td>
                            <td class="bid-amount">{{ $bid->amount }}</td>
                            <td class="location">{{ $bid->delivery_location }}</td>
                            <td class="status under-review">{{ $bid->status }}</td>
                            <td class="date">{{ $bid->created_at }}</td>
                            <td class="actions">
                                <button class="action-btn" onclick="toggleActionMenu(this)">
                                    <i class="fas fa-ellipsis-h"></i>
                                </button>
                                <div class="action-menu">
                                    <a href="#" class="action-menu-item">
                                        <i class="fas fa-edit"></i> Edit
                                    </a>
                                    <a href="#" class="action-menu-item">
                                        <i class="fas fa-envelope"></i> Message
                                    </a>
                                    <a href="#" class="action-menu-item">
                                        <i class="fas fa-upload"></i> Upload Docs
                                    </a>
                                    <a href="#" class="action-menu-item">
                                        <i class="fas fa-trash"></i> Delete
                                    </a>
                                </div>
                            </td>
                    @endforeach
                    </tr>
                </tbody>
            </table>
        </div>

    </main>

    <script>
        // Action menu toggle functionality
        function toggleActionMenu(button) {
            const menu = button.nextElementSibling;
            const allMenus = document.querySelectorAll('.action-menu');

            // Close all other menus
            allMenus.forEach(m => {
                if (m !== menu) m.classList.remove('show');
            });

            // Toggle current menu
            menu.classList.toggle('show');
        }

        // Close action menus when clicking outside
        document.addEventListener('click', function(event) {
            if (!event.target.closest('.actions')) {
                document.querySelectorAll('.action-menu').forEach(menu => {
                    menu.classList.remove('show');
                });
            }
        });

        // Tab functionality for filtering bids
        document.querySelectorAll('.tab').forEach(tab => {
            tab.addEventListener('click', function() {
                // Reset active tab
                document.querySelectorAll('.tab').forEach(t => t.classList.remove('active'));
                this.classList.add('active');

                const selectedStatus = this.textContent.trim().toLowerCase();

                // Show/hide rows based on status
                document.querySelectorAll('tbody tr').forEach(row => {
                    const rowStatus = (row.getAttribute('data-status') || '').trim().toLowerCase();

                    if (selectedStatus === 'all bids' || rowStatus === selectedStatus) {
                        row.style.display = ''; // show
                    } else {
                        row.style.display = 'none'; // hide
                    }
                });
            });
        });



        // Navigation functionality
        document.querySelectorAll('.nav-item').forEach(item => {
            item.addEventListener('click', function(e) {
                e.preventDefault();
                document.querySelectorAll('.nav-item').forEach(nav => nav.classList.remove('active'));
                this.classList.add('active');
            });
        });
    </script>
</body>

</html>
