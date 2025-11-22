<link href="https://cdn.jsdelivr.net/npm/summernote@0.8.20/dist/summernote-lite.min.css" rel="stylesheet">
<form action="{{ route('post.store') }}" method="POST">
    @csrf
    {{-- Content --}}
    <div class="mb-3">
        <label class="form-label">Post <span class="text-danger"></span></label>
        <textarea name="post" id="summernote" class="form-control @error('post') is-invalid @enderror" rows="7"
            required>{{ old('post') }}</textarea>

        @error('post')
        <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>


    <input type="hidden" value="{{ $course->id }}" name="course_id">

    <div class="d-grid gap-2 d-md-flex justify-content-md-end">
        <button type="submit" class="btn btn-primary">Post</button>
    </div>
</form>

<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
<script src="https://code.jquery.com/ui/1.13.2/jquery-ui.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="https://cdn.jsdelivr.net/npm/summernote@0.8.20/dist/summernote-lite.min.js"></script>



{{-- =========================================
SCRIPT SUMMERNOTE + INSERT PDF
========================================= --}}
<script>
    $(document).ready(function() {

    // ************************************
    // Custom Button Insert PDF
    // ************************************
    var InsertPDFButton = function(context) {
        var ui = $.summernote.ui;

        var button = ui.button({
            contents: '<i class="note-icon-link"></i> PDF',
            tooltip: 'Insert PDF',
            click: function() {
                var pdfUrl = prompt("Masukkan URL PDF:");

                if (pdfUrl) {
                    var iframe = `<iframe src="${pdfUrl}" width="100%" height="700px"
                        style="border:1px solid #ccc;"></iframe>`;

                    context.invoke('editor.pasteHTML', iframe);
                }
            }
        });

        return button.render();
    };

    // ************************************
    // Init Summernote
    // ************************************
    $('#summernote').summernote({
        placeholder: 'Write your content here...',
        tabsize: 2,
        height: 300,

        toolbar: [
            ['style', ['style']],
            ['font', ['bold', 'underline', 'italic', 'clear']],
            ['color', ['color']],
            ['para', ['ul', 'ol', 'paragraph']],
            ['insert', ['link', 'picture', 'video', 'insertPDF']],
            ['view', ['fullscreen', 'codeview', 'help']]
        ],

        buttons: {
            insertPDF: InsertPDFButton
        },

        callbacks: {
            onMediaDelete: function(target) {
                target.remove();
            }
        }
    });

});
</script>