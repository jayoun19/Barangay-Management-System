<x-app-layout>
    {{-- FullCalendar & Google Fonts --}}
    <script src='https://cdn.jsdelivr.net/npm/fullcalendar@6.1.10/index.global.min.js'></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;800&display=swap" rel="stylesheet">

    <div class="space-y-6 p-4 sm:p-8 bg-slate-50 dark:bg-slate-950 min-h-screen">
        {{-- Header Section --}}
        <div class="flex flex-col md:flex-row md:items-center justify-between gap-4 max-w-7xl mx-auto">
            <div class="space-y-1">
                <h2 class="text-3xl font-black text-slate-900 dark:text-white uppercase tracking-tighter">
                    Barangay <span class="text-blue-600">Events</span>
                </h2>
                <p class="text-xs font-bold text-slate-500 uppercase tracking-[0.2em]">Community Schedule & Planning</p>
            </div>
            
            <a href="{{ route('calendar.create') }}" class="group inline-flex items-center gap-3 rounded-2xl bg-slate-900 dark:bg-blue-600 px-6 py-4 text-[11px] font-black uppercase tracking-widest text-white hover:bg-blue-600 dark:hover:bg-blue-500 transition-all shadow-xl shadow-blue-500/10 active:scale-95">
                <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M12 4v16m8-8H4"/></svg>
                New Activity
            </a>
        </div>

        {{-- Main Calendar Card --}}
        <div class="max-w-7xl mx-auto">
            <div class="bg-white dark:bg-slate-900 rounded-[2.5rem] p-6 sm:p-10 border border-slate-200 dark:border-slate-800 shadow-sm transition-all overflow-hidden">
                <div id='calendar' class="min-h-[750px]"></div>
            </div>
        </div>
    </div>

    <style>
        /* Professional Calendar Theming */
        :root {
            --fc-border-color: transparent;
            --fc-daygrid-dot-event-hover-bg-color: #f1f5f9;
        }

        /* Font at Body */
        #calendar {
            font-family: 'Inter', sans-serif;
            --fc-today-bg-color: rgba(37, 99, 235, 0.04);
        }

        /* Toolbar / Buttons */
        .fc .fc-toolbar-title {
            font-size: 1.25rem !important;
            font-weight: 800 !important;
            text-transform: uppercase;
            letter-spacing: -0.02em;
            color: #0f172a;
        }
        .dark .fc .fc-toolbar-title { color: #f8fafc; }

        .fc .fc-button {
            background: #ffffff !important;
            border: 1px solid #e2e8f0 !important;
            color: #475569 !important;
            font-size: 0.7rem !important;
            font-weight: 700 !important;
            text-transform: uppercase !important;
            letter-spacing: 0.05em !important;
            padding: 8px 16px !important;
            border-radius: 12px !important;
            box-shadow: none !important;
            transition: all 0.2s ease;
        }
        .dark .fc .fc-button {
            background: #1e293b !important;
            border: 1px solid #334155 !important;
            color: #94a3b8 !important;
        }

        .fc .fc-button-primary:not(:disabled).fc-button-active,
        .fc .fc-button-primary:not(:disabled):hover {
            background: #0f172a !important;
            color: #ffffff !important;
            border-color: #0f172a !important;
        }
        .dark .fc .fc-button-primary:not(:disabled).fc-button-active {
            background: #3b82f6 !important;
            border-color: #3b82f6 !important;
        }

        /* Day Headers */
        .fc .fc-col-header-cell-cushion {
            padding: 15px 0 !important;
            font-size: 0.65rem !important;
            font-weight: 800 !important;
            text-transform: uppercase;
            letter-spacing: 0.1em;
            color: #64748b !important;
        }

        /* Event Styling */
        .fc-event {
            border: none !important;
            padding: 4px 8px !important;
            border-radius: 8px !important;
            font-size: 0.75rem !important;
            font-weight: 600 !important;
            margin: 2px 4px !important;
            transition: transform 0.1s ease !important;
            cursor: pointer !important;
        }
        .fc-event:hover {
            transform: translateY(-1px);
            filter: brightness(95%);
        }

        /* Grid & Cell Styling */
        .fc .fc-daygrid-day-number {
            font-size: 0.85rem !important;
            font-weight: 600 !important;
            padding: 12px !important;
            color: #64748b;
        }
        .fc .fc-day-today .fc-daygrid-day-number {
            color: #2563eb !important;
            font-weight: 800 !important;
        }
        
        .fc .fc-theme-standard td, .fc .fc-theme-standard th {
            border: 1px solid #f1f5f9 !important;
        }
        .dark .fc .fc-theme-standard td, .dark .fc .fc-theme-standard th {
            border: 1px solid #1e293b !important;
        }

        /* Remove yellow today highlight */
        .fc .fc-daygrid-day.fc-day-today {
            background-color: var(--fc-today-bg-color) !important;
        }

        /* Hide License Message if any */
        .fc-license-message { display: none; }
    </style>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const calendarEl = document.getElementById('calendar');
            const calendar = new FullCalendar.Calendar(calendarEl, {
                initialView: 'dayGridMonth',
                height: 'auto',
                headerToolbar: {
                    left: 'prev,next today',
                    center: 'title',
                    right: 'dayGridMonth,timeGridWeek,listMonth'
                },
                // Kinukuha ang data mula sa controller
                events: @json($events),
                
                eventTimeFormat: {
                    hour: 'numeric',
                    minute: '2-digit',
                    meridiem: 'short'
                },
                
                dayMaxEvents: true, // "+ more" kapag marami ng events
                
                eventClick: function(info) {
                    // Maganda itong lagyan ng SweetAlert2 details
                    alert('Activity: ' + info.event.title + '\nLocation: ' + (info.event.extendedProps.location || 'N/A'));
                }
            });
            calendar.render();
        });
    </script>
</x-app-layout>