<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>TheraConnect - Dashboard</title>
    
    <!-- Bootstrap 5 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    <!-- Google Fonts: Inter -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700&display=swap" rel="stylesheet">
    
    <style>
        :root {
            --thera-primary: #d97757;
            --thera-bg: #fdfaf7;
            --thera-sidebar: #ffffff;
        }
        body { 
            background-color: var(--thera-bg); 
            font-family: 'Inter', sans-serif; 
        }
        .sidebar { 
            width: 260px; 
            height: 100vh; 
            background: var(--thera-sidebar); 
            border-right: 1px solid #eee; 
            position: fixed; 
            left: 0;
            top: 0;
        }
        .main-content { 
            margin-left: 260px; 
            padding: 40px; 
        }
        .nav-link { 
            color: #888; 
            padding: 12px 20px; 
            border-radius: 10px; 
            margin: 5px 15px; 
            display: flex; 
            align-items: center; 
            gap: 12px;
            text-decoration: none;
            transition: 0.2s;
        }
        .nav-link i { font-size: 1.1rem; }
        .nav-link:hover { background: #f9f9f9; color: var(--thera-primary); }
        .nav-link.active { 
            background: #fef2f0; 
            color: var(--thera-primary); 
            font-weight: 600; 
        }
        .stat-card { 
            background: white; 
            border-radius: 20px; 
            border: none; 
            padding: 25px; 
            box-shadow: 0 4px 15px rgba(0,0,0,0.02); 
            height: 100%;
        }
        .btn-add { 
            background-color: var(--thera-primary); 
            border: none; 
            border-radius: 12px; 
            padding: 12px 24px; 
            color: white; 
            font-weight: 600;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
            min-height: 44px;
            cursor: pointer;
            transition: 0.2s;
        }
        .up-next-card { 
            background: linear-gradient(135deg, #e49277, #d97757); 
            border-radius: 20px; 
            color: white; 
            padding: 25px; 
            box-shadow: 0 10px 20px rgba(217, 119, 87, 0.2);
        }
        .profile-circle {
            width: 45px;
            height: 45px;
            background-color: #6c757d;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-weight: bold;
            text-transform: uppercase;
        }
        .search-icon-wrapper {
            position: relative;
            width: 50%;
        }
        .search-icon-wrapper i {
            position: absolute;
            left: 15px;
            top: 50%;
            transform: translateY(-50%);
            color: #ccc;
        }
        .search-icon-wrapper input {
            padding-left: 45px !important;
        }
    </style>
</head>
<body>

<div class="sidebar d-flex flex-column p-3">
    <div class="px-3 mb-5 mt-2">
        <h4 class="fw-bold mb-0" style="color: var(--thera-primary);">T <span class="text-dark h5 fw-bold">Theraconnect</span></h4>
    </div>
    
    <div class="nav flex-column mb-auto">
        <a href="{{ route('dashboard') }}" class="nav-link {{ Request::routeIs('dashboard') ? 'active' : '' }}">
            <i class="bi bi-grid-fill"></i> Overview
        </a>
        <a href="{{ route('schedule') }}" class="nav-link {{ Request::routeIs('schedule') ? 'active' : '' }}">
            <i class="bi bi-calendar-event"></i> Schedule
        </a>
        <a href="{{ route('requests') }}" class="nav-link {{ Request::routeIs('requests') ? 'active' : '' }}">
            <i class="bi bi-file-earmark-text"></i> Requests
        </a>
        <a href="{{ route('patients') }}" class="nav-link {{ Request::routeIs('patients') ? 'active' : '' }}">
            <i class="bi bi-people"></i> Patients
        </a>
        <a href="{{ route('messages') }}" class="nav-link {{ Request::routeIs('messages') ? 'active' : '' }}">
            <i class="bi bi-chat-dots"></i> Messages
        </a>
        <a href="{{ route('assignments') }}" class="nav-link {{ Request::routeIs('assignments') ? 'active' : '' }}">
            <i class="bi bi-journal-check"></i> Assignments
        </a>
    </div>
    
    <div class="nav flex-column border-top pt-3">
        <a href="{{ route('settings') }}" class="nav-link {{ Request::routeIs('settings') ? 'active' : '' }}">
            <i class="bi bi-gear"></i> Settings
        </a>
        <a href="/logout" class="nav-link text-danger">
            <i class="bi bi-box-arrow-right"></i> Sign Out
        </a>
    </div>
</div>

<div class="main-content">
    <!-- Top Header -->
    <div class="d-flex justify-content-between align-items-center mb-5">
        <div class="search-icon-wrapper">
            <i class="bi bi-search"></i>
            <input type="text" class="form-control border-0 bg-white shadow-sm py-2 px-3" style="border-radius: 15px;" placeholder="Search patients, appointments...">
        </div>
        
        <div class="d-flex align-items-center gap-3">
            <div class="text-end">
                <p class="mb-0 fw-bold">{{ Auth::user()->full_name }}</p>
                <small class="text-muted text-capitalize">{{ Auth::user()->role }}</small>
            </div>
            <div class="profile-circle shadow-sm">
                {{ substr(Auth::user()->full_name, 0, 1) }}
            </div>
        </div>
    </div>

    <!-- Greeting Section -->
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h2 class="fw-bold mb-1">Good morning, {{ explode(' ', Auth::user()->full_name)[0] }}</h2>
            <p class="text-muted">Here's what your day looks like today.</p>
        </div>
        <button class="btn-add shadow-sm">
            <i class="bi bi-plus-lg"></i> Add Appointment
        </button>
    </div>

    <div class="row g-4">
        <div class="col-lg-8">
            <div class="row g-3 mb-5">
                <div class="col-md-4">
                    <div class="stat-card">
                        <small class="text-muted d-block mb-2">Appointments Today</small>
                        <h2 class="fw-bold mb-0">0</h2> 
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="stat-card">
                        <small class="text-muted d-block mb-2">New Patients</small>
                        <h2 class="fw-bold mb-0">0</h2>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="stat-card">
                        <small class="text-muted d-block mb-2">Hours Scheduled</small>
                        <h2 class="fw-bold mb-0">0</h2>
                    </div>
                </div>
            </div>

            <h5 class="fw-bold mb-4">Today's Schedule</h5>
            <div class="bg-white shadow-sm p-5 text-center" style="border-radius: 20px;">
                <p class="text-muted mb-0">No appointments scheduled for today.</p>
            </div>
        </div>

        <div class="col-lg-4">
            <div class="up-next-card shadow-sm mb-4">
                <p class="small opacity-75 mb-2">
                    <i class="bi bi-record-fill text-white-50"></i> Up Next
                </p>
                <h3 class="fw-bold mb-1">---</h3>
                <p class="small mb-4">No upcoming sessions</p>
                <button class="btn btn-light w-100 fw-bold py-2 disabled d-flex align-items-center justify-content-center" style="border-radius: 12px; color: var(--thera-primary); min-height: 44px;">Start Session</button>
            </div>

            <div class="stat-card">
                <h6 class="fw-bold mb-4">Recent Messages</h6>
                <div class="text-center py-3">
                    <p class="small text-muted mb-0">Your inbox is empty.</p>
                </div>
            </div>
        </div>
    </div>
</div>

</body>
</html>