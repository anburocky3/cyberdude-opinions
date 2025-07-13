<div>

    <div
        x-data="{ value: @entangle($attributes->wire('model')) }"
        x-init="
        tinyMCE.remove($refs.tinymce);
        tinyMCE.init({
             target: $refs.tinymce,
            menubar: false,
            highlight_on_focus: false,
            plugins: [
                'lists',
                'autolink',
                'code fullscreen',
            ],
            external_plugins: {
                'image': 'https://cdn.tiny.cloud/1/8e0tvf552q63voxxewspqlsr5xhp69qpnysx71n7cx7f507c/tinymce/7/plugins/image/plugin.min.js',
                'code': 'https://cdn.tiny.cloud/1/8e0tvf552q63voxxewspqlsr5xhp69qpnysx71n7cx7f507c/tinymce/7/plugins/code/plugin.min.js',
                'fullscreen': 'https://cdn.tiny.cloud/1/8e0tvf552q63voxxewspqlsr5xhp69qpnysx71n7cx7f507c/tinymce/7/plugins/fullscreen/plugin.min.js'
            },
            toolbar: 'undo redo styles bold italic alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image code fullscreen',
            setup: function(editor) {
                editor.on('blur', function(e) {
                    value = editor.getContent()
                })
                editor.on('init', function (e) {
                    if (value != null) {
                        editor.setContent(value)
                    }
                })
                function putCursorToEnd() {
                    editor.selection.select(editor.getBody(), true);
                    editor.selection.collapse(false);
                }
                $watch('value', function (newValue) {
                    if (newValue !== editor.getContent()) {
                        editor.resetContent(newValue || '');
                        putCursorToEnd();
                    }
                });
            }
        })
    "
        wire:ignore
    >
        <div>
            <x-forms.textarea
                x-ref="tinymce"
                {{ $attributes->whereDoesntStartWith('wire:model') }}
            ></x-forms.textarea>
        </div>
    </div>
</div>
