<x-app-layout>
     @section('header_title', 'ANNOUNCEMENTS')
    <x-slot name="header">Edit Announcement</x-slot>

    <div class="card-surface">
        <form action="{{ route('announcements.update', $announcement) }}" method="POST" class="space-y-6">
            @csrf
            @method('PATCH')

            <div>
                <label class="input-label">Title</label>
                <input type="text" name="title" value="{{ old('title', $announcement->title) }}" class="form-field" required>
                @error('title')
                    <span class="input-error">{{ $message }}</span>
                @enderror
            </div>

            <div>
                <label class="input-label">Category</label>
                <select name="category" class="form-field" required>
                    <option value="">Select a category</option>
                    <option value="General" {{ old('category', $announcement->category) == 'General' ? 'selected' : '' }}>General</option>
                    <option value="Meeting" {{ old('category', $announcement->category) == 'Meeting' ? 'selected' : '' }}>Meeting</option>
                    <option value="Health" {{ old('category', $announcement->category) == 'Health' ? 'selected' : '' }}>Health</option>
                    <option value="Emergency" {{ old('category', $announcement->category) == 'Emergency' ? 'selected' : '' }}>Emergency</option>
                    <option value="Event" {{ old('category', $announcement->category) == 'Event' ? 'selected' : '' }}>Event</option>
                </select>
                @error('category')
                    <span class="input-error">{{ $message }}</span>
                @enderror
            </div>

            <div>
                <label class="input-label">Content</label>
                <textarea name="content" rows="6" class="form-field" required>{{ old('content', $announcement->content) }}</textarea>
                @error('content')
                    <span class="input-error">{{ $message }}</span>
                @enderror
            </div>

            <div class="flex gap-3">
                <a href="{{ route('announcements.index') }}" class="btn-secondary">Cancel</a>
                <button type="submit" class="btn-primary">Update Announcement</button>
            </div>
        </form>
    </div>
</x-app-layout>
