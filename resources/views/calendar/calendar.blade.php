<div class="bg-white rounded-[2.5rem] p-8 border border-slate-200 shadow-sm">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <div class="flex items-center justify-between mb-6">
        <div>
            <h3 class="text-lg font-bold text-slate-800">Barangay Calendar</h3>
            <p class="text-sm text-slate-500">Yearly calendar view with activities and event planning</p>
        </div>
        <span class="text-xs uppercase tracking-[0.3em] text-slate-400">Calendar</span>
    </div>

    <div class="grid gap-6 lg:grid-cols-2">
        <div class="rounded-[2rem] border border-slate-200 bg-slate-50 p-6">
            <div class="mb-6 flex items-center justify-between">
                <div>
                    <p class="text-sm font-semibold text-slate-500 uppercase tracking-[0.25em]">Year overview</p>
                    <h4 class="text-xl font-bold text-slate-900">{{ $currentYear }}</h4>
                </div>
                <span class="rounded-full bg-white px-4 py-2 text-xs font-semibold text-slate-600 border border-slate-200">{{ count($calendarEvents) }} events</span>
            </div>

            <div class="grid grid-cols-3 gap-3">
                @foreach(['Jan','Feb','Mar','Apr','May','Jun','Jul','Aug','Sep','Oct','Nov','Dec'] as $monthIndex => $monthName)
                    @php
                        $monthNumber = $monthIndex + 1;
                        $eventCount = collect($calendarEvents)->filter(function ($event) use ($monthNumber) {
                            return \Carbon\Carbon::parse($event['date'])->month === $monthNumber;
                        })->count();
                    @endphp
                    <div data-month="{{ $monthNumber }}" class="rounded-3xl border border-slate-200 bg-white p-3 text-center">
                        <p class="text-sm font-semibold text-slate-700">{{ $monthName }}</p>
                        <p data-month-count class="text-3xl font-black text-slate-900 mt-3">{{ $eventCount }}</p>
                        <p class="text-xs uppercase tracking-[0.2em] text-slate-400 mt-2">events</p>
                    </div>
                @endforeach
            </div>
        </div>

        <div class="rounded-[2rem] border border-slate-200 bg-slate-50 p-6">
            <div class="mb-6 flex items-center justify-between gap-4">
                <div>
                    <p class="text-sm font-semibold text-slate-500 uppercase tracking-[0.25em]">Event planner</p>
                    <h4 class="text-xl font-bold text-slate-900">Add activities</h4>
                </div>
                <span class="inline-flex items-center rounded-full bg-emerald-50 px-3 py-1 text-xs font-semibold text-emerald-700">Live</span>
            </div>

            <form id="eventForm" class="space-y-4">
                <div>
                    <label class="block text-xs font-semibold uppercase tracking-[0.2em] text-slate-500 mb-2">Title</label>
                    <input id="eventTitle" type="text" placeholder="Activity name" class="w-full rounded-3xl border border-slate-200 bg-white px-4 py-3 text-sm text-slate-700 shadow-sm focus:border-blue-300 focus:ring-2 focus:ring-blue-100" />
                </div>
                <div class="grid gap-4 sm:grid-cols-2">
                    <div>
                        <label class="block text-xs font-semibold uppercase tracking-[0.2em] text-slate-500 mb-2">Date</label>
                        <input id="eventDate" type="date" class="w-full rounded-3xl border border-slate-200 bg-white px-4 py-3 text-sm text-slate-700 shadow-sm focus:border-blue-300 focus:ring-2 focus:ring-blue-100" />
                    </div>
                    <div>
                        <label class="block text-xs font-semibold uppercase tracking-[0.2em] text-slate-500 mb-2">Location</label>
                        <input id="eventLocation" type="text" placeholder="Venue" class="w-full rounded-3xl border border-slate-200 bg-white px-4 py-3 text-sm text-slate-700 shadow-sm focus:border-blue-300 focus:ring-2 focus:ring-blue-100" />
                    </div>
                </div>
                <div>
                    <label class="block text-xs font-semibold uppercase tracking-[0.2em] text-slate-500 mb-2">Notes</label>
                    <textarea id="eventDescription" rows="3" placeholder="Details or reminders" class="w-full rounded-3xl border border-slate-200 bg-white px-4 py-3 text-sm text-slate-700 shadow-sm focus:border-blue-300 focus:ring-2 focus:ring-blue-100"></textarea>
                </div>
                <button type="submit" class="w-full rounded-3xl bg-slate-900 px-5 py-3 text-sm font-bold text-white shadow-lg transition hover:bg-slate-800">Add activity</button>
            </form>
        </div>
    </div>

    <div class="mt-8 rounded-[2rem] border border-slate-200 bg-white p-6 shadow-sm">
        <div class="flex items-center justify-between mb-6">
            <div>
                <p class="text-sm font-semibold text-slate-500 uppercase tracking-[0.25em]">Upcoming activities</p>
                <h4 class="text-lg font-bold text-slate-900">Scheduled this year</h4>
            </div>
        </div>

        <div id="eventList" class="space-y-4">
            @foreach($calendarEvents as $event)
                <div class="rounded-[1.75rem] border border-slate-200 bg-slate-50 p-4">
                    <div class="flex items-start justify-between gap-4">
                        <div>
                            <p class="font-semibold text-slate-900">{{ $event['title'] }}</p>
                            <p class="text-sm text-slate-500">{{ $event['location'] }}</p>
                        </div>
                        <div class="text-right">
                            <p class="text-sm font-bold text-slate-700">{{ \Carbon\Carbon::parse($event['date'])->format('M d, Y') }}</p>
                            <p class="text-xs uppercase tracking-[0.2em] text-slate-400">{{ \Carbon\Carbon::parse($event['date'])->format('l') }}</p>
                        </div>
                    </div>
                    <p class="mt-3 text-sm leading-6 text-slate-600">{{ $event['description'] }}</p>
                </div>
            @endforeach
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const eventForm = document.getElementById('eventForm');
            const eventList = document.getElementById('eventList');
            const months = Array.from(document.querySelectorAll('[data-month]'));

            function createEventCard(event) {
                const wrapper = document.createElement('div');
                wrapper.className = 'rounded-[1.75rem] border border-slate-200 bg-slate-50 p-4';
                wrapper.innerHTML = `
                    <div class="flex items-start justify-between gap-4">
                        <div>
                            <p class="font-semibold text-slate-900">${event.title}</p>
                            <p class="text-sm text-slate-500">${event.location}</p>
                        </div>
                        <div class="text-right">
                            <p class="text-sm font-bold text-slate-700">${event.dateFormatted}</p>
                            <p class="text-xs uppercase tracking-[0.2em] text-slate-400">${event.weekday}</p>
                        </div>
                    </div>
                    <p class="mt-3 text-sm leading-6 text-slate-600">${event.description}</p>
                `;
                return wrapper;
            }

            function updateMonthCount(monthIndex) {
                const monthCard = document.querySelector(`[data-month='${monthIndex}']`);
                if (!monthCard) return;
                const countEl = monthCard.querySelector('[data-month-count]');
                const currentCount = Number(countEl.textContent || 0);
                countEl.textContent = currentCount + 1;
            }

            eventForm.addEventListener('submit', function (event) {
                event.preventDefault();
                const title = document.getElementById('eventTitle').value.trim();
                const date = document.getElementById('eventDate').value;
                const location = document.getElementById('eventLocation').value.trim();
                const description = document.getElementById('eventDescription').value.trim();

                if (!title || !date || !location) {
                    alert('Please fill in all required fields.');
                    return;
                }

                const formData = new FormData();
                formData.append('title', title);
                formData.append('date', date);
                formData.append('location', location);
                formData.append('description', description);
                formData.append('_token', document.querySelector('meta[name="csrf-token"]').getAttribute('content'));

                fetch('{{ route("calendar.store") }}', {
                    method: 'POST',
                    body: formData
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        const dateObj = new Date(date);
                        const options = { month: 'short', day: '2-digit', year: 'numeric' };
                        const weekdayOptions = { weekday: 'long' };
                        const formattedDate = new Intl.DateTimeFormat('en-US', options).format(dateObj);
                        const weekday = new Intl.DateTimeFormat('en-US', weekdayOptions).format(dateObj);
                        const monthIndex = dateObj.getMonth() + 1;

                        const newEvent = {
                            title,
                            location,
                            description,
                            dateFormatted: formattedDate,
                            weekday
                        };

                        eventList.prepend(createEventCard(newEvent));
                        updateMonthCount(monthIndex);
                        eventForm.reset();
                        alert(data.message);
                    } else {
                        alert('Error adding event.');
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    alert('Error adding event.');
                });
            });
        });
    </script>
</div>
