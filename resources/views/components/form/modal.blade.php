@props(['title', 'action', 'label', 'hasFile' => false])

<button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#formModal">
    {{ $label }}
</button>

<!-- Modal -->
<x-component.modal id="formModal" :title="$title">
    <form action="{{ $action }}" method="POST" autocomplete="off"
        @if ($hasFile) enctype="multipart/form-data" @endif>
        @csrf
        <div class="modal-body">
            {{ $slot }}
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">
                Close
            </button>
            <button type="submit" class="btn btn-primary">Submit</button>
        </div>
    </form>
</x-component.modal>
