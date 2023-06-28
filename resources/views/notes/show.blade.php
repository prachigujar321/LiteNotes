<x-app-layout>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ !$note->trashed() ? __('Notes') : __('Trash') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <x-alert-success>
                {{ session('success') }}
            </x-alert-success>
            
            <div class="flex">
                @if(!$note->trashed())
                    <p class="opacity-70">
                        <strong>Created: </strong> {{ $note->created_at }}
                    </p>
                    <p class="" style="margin-left: 50px;">
                        <strong>Updated: </strong> {{ $note->updated_at }}
                    </p>
                    <a  href="{{ route('notes.edit', $note) }}" class="btn btn-primary ml-2">Edit Note</a>
                    <form action="{{ route('notes.destroy', $note) }}" class="btn btn-danger ml-2 " method="post">
                        @method('delete')
                        @csrf
                        <button type="submit" class="btn btn-danger ml-4" onclick="return confirm('Are you sure you wish to move this to trash? ')">Move To Trash</button>
                    </form>
                @else
                    <p class="opacity-70">
                        <strong>Deleted: </strong> {{ $note->deleted_at }}
                    </p>
                    <form action="{{ route('trashed.update',$note) }}" method="post">
                        @method('put')
                        @csrf
                        <button type="submit" class="btn btn-primary ml-2">Restore Note</button>
                    </form>
                   
                    <form action="{{ route('trashed.destroy', $note) }}" method="post">
                        @method('delete')
                        @csrf
                        <button type="submit" class="btn btn-danger ml-4" onclick="return confirm('Are you sure you wish to delete this note forever? This action cannot be undone')">Delete Forever</button>
                    </form>
                @endif
            </div>
            <div class="my-6 p-6 bg-white border-b border-gray-200 shadow-sm sm:rounded-lg mt-2">
                <h2 class="font-bold text-4xl">
                    {{ $note->title }}
                </h2>
                <p class="mt-6 whitespace-pre-wrap">{{ $note->text }}</p>
            </div>
        </div>
    </div>
</x-app-layout>