<script type="importmap">
    {
        "imports": {
            "ckeditor5": "https://cdn.ckeditor.com/ckeditor5/42.0.2/ckeditor5.js",
            "ckeditor5/": "https://cdn.ckeditor.com/ckeditor5/42.0.2/"
        }
    }
 </script>
<script type="module">
    import {
        ClassicEditor,
        Essentials,
        Bold,
        Italic,
        Underline,
        Strikethrough,
        Code,
        BlockQuote,
        Link,
        List,
        TodoList,
        Image,
        ImageToolbar,
        ImageUpload,
        ImageCaption,
        ImageStyle,
        ImageResize,
        MediaEmbed,
        Table,
        TableToolbar,
        TableProperties,
        TableCellProperties,
        Font,
        Highlight,
        Alignment,
        Indent,
        IndentBlock,
        HtmlEmbed,
        SourceEditing,
        RemoveFormat,
        Undo,
        SpecialCharacters,
        SpecialCharactersEssentials,
        PageBreak,
        HorizontalLine,
        CodeBlock,
        Subscript,
        Superscript,
        TextPartLanguage,
        Mention,
        Heading,
        Paragraph,
        SimpleUploadAdapter
    } from 'ckeditor5';

    window.editorInstances = [];

    function initCK(el) {
        const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

        ClassicEditor
            .create(el, {
                plugins: [
                    Essentials,
                    Bold,
                    Italic,
                    Underline,
                    Strikethrough,
                    Code,
                    BlockQuote,
                    Link,
                    List,
                    TodoList,
                    Image,
                    ImageToolbar,
                    ImageUpload,
                    ImageCaption,
                    ImageStyle,
                    ImageResize,
                    MediaEmbed,
                    Table,
                    TableToolbar,
                    TableProperties,
                    TableCellProperties,
                    Font,
                    Highlight,
                    Alignment,
                    Indent,
                    IndentBlock,
                    HtmlEmbed,
                    SourceEditing,
                    RemoveFormat,
                    Undo,
                    SpecialCharacters,
                    SpecialCharactersEssentials,
                    PageBreak,
                    HorizontalLine,
                    CodeBlock,
                    Subscript,
                    Superscript,
                    TextPartLanguage,
                    Mention,
                    Heading,
                    Paragraph,
                    SimpleUploadAdapter
                ],
                toolbar: {
                    shouldNotGroupWhenFull: true,
                    items: [
                        'heading',
                        'bold',
                        'italic',
                        'underline',
                        'strikethrough',
                        'code',
                        'blockQuote',
                        'link',
                        'bulletedList',
                        'numberedList',
                        'todoList',
                        'imageUpload',
                        'mediaEmbed',
                        'insertTable',
                        'tableColumn',
                        'tableRow',
                        'mergeTableCells',
                        'fontFamily',
                        'fontSize',
                        'fontColor',
                        'fontBackgroundColor',
                        'highlight',
                        'alignment',
                        'indent',
                        'outdent',
                        'htmlEmbed',
                        'sourceEditing',
                        'removeFormat',
                        'undo',
                        'specialCharacters',
                        'pageBreak',
                        'horizontalLine',
                        'codeBlock',
                        'subscript',
                        'superscript',
                        'textPartLanguage',
                        'mention'
                    ]
                },
                menuBar: {
                    isVisible: true
                },
                simpleUpload: {
                    uploadUrl: '/admin_panel/storage/files/upload',
                    headers: {
                        'X-CSRF-TOKEN': csrfToken
                    }
                },
                contextMenu: {
                    items: [
                        'cut',
                        'copy',
                        'paste',
                        'bold',
                        'italic',
                        'link'
                    ]
                },
                htmlSupport: {
                    allow: [{
                        name: /.*/, // Разрешаем все теги
                        attributes: true, // Разрешаем все атрибуты
                        classes: true, // Разрешаем все классы
                        styles: true // Разрешаем все стили
                    }]
                },
                htmlEmbed: {
                    showPreviews: true
                }
            })
            .then(editor => {
                console.log('Editor was initialized', editor);
                window.editorInstances.push(editor);
            })
            .catch(error => {
                console.error(error);
            });

            $(el).data('initialized', true);

    }
    
    document.addEventListener('DOMContentLoaded', () => {
        initCK(document.querySelector('.ckeditor'));
    });



    window.initCKEditor = function () {
        $('.ckeditor').each(function() {
            if (!$(this).data('initialized')) {
                initCK(this);
                $(this).data('initialized', true);
            }
        });
    }
</script>
