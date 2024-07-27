@props(['title', 'action', 'label'])

<button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#formModal">
    {{ $label }}
</button>

<!-- Modal -->
<x-component.modal id="formModal" :title="$title">
    <form action="{{ $action }}" method="POST" autocomplete="off">
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
