<x-base>
    <h1>Create page</h1>
    <form action="{{ route('page.store') }}" method="POST">
        @csrf
        <input type="hidden" value="{{ $parentId }}" name="parent_id" id="parent_id" />
        <div>
            <label for="title">Title</label>
            <input type="text" name="title" id="title" value="{{ old('title') }}">
            @error('title') <p>{{ $message }}</p> @enderror
        </div>
        @error('parent_id') <p>{{ $message }}</p> @enderror
        <button type="submit">Create page</button>
    </form>
</x-base>
