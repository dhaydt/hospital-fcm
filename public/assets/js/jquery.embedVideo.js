(function($){
    jQuery.fn.embedVideo = function(pluginOptions) {
        return this.each(function() {
            /**
             * Клонируем настройки по-умолчанию.
             * В кратце, объекты в JS передают ссылку на память (а не на объект) где они хранятся.
             * Если мы просто возьмем настройки, как с переменными:
             *      defaultOptions = pluginMethods.defaultOptions;
             *
             *  Каждый контейнер видео, начнет добавлять в нее свои настройки,
             *  и по сути, выйдет что все контейнеры будут использовать их одни и те же.
             *
             *  Поэтому сначала клонируем их, а после используем.
             *
             * https://learn.javascript.ru/object-reference
             * @type {{}}
             */
            var defaultOptions = {};
            for (var key in pluginMethods.defaultOptions) {
                defaultOptions[key] = pluginMethods.defaultOptions[key];
            }

            var containerOptions = $.extend(defaultOptions, pluginOptions, $(this).data());
            pluginMethods.init.apply(this, [containerOptions]);
        });
    };

    var pluginMethods = {
        /**
         * Настройки по-умолчанию
         */
        defaultOptions : {
            /**
             * default       - версия по умолчанию (120px * 90px);
             * mqdefault     - версия среднего качества (320px * 180px);
             * hqdefault     - версия высокого качества (480px * 360px);
             * sddefault     - версия стандартного разрешения (640px * 480px);
             * maxresdefault - версия максимального разрешения (1280px * 720px);
             */
            sizePreview: '',
            /**
             * Автоматическое определение размера превью по размеру контейнера
             */
            autoSizePreview: true,
            /**
             * Алтернативный превью
             */
            alternativeCover: false,
            /**
             * Кнопка контейнера
             */
            imagePlayContainer: '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 428.41 301.36" height="50"><path d="M639.64,440.2l115.76-60-115.76-60.4Z" transform="translate(-469.68 -233.97)" fill="#fff"/><path d="M893.81,299s-4.19-29.53-17-42.53c-16.27-17.07-34.56-17.16-42.9-18.16C773.9,234,684,234,684,234h-.17s-89.92,0-149.9,4.32c-8.35,1-26.64,1.09-42.91,18.16-12.84,13-17,42.53-17,42.53a647.81,647.81,0,0,0-4.28,69.33v32.51A648.06,648.06,0,0,0,474,470.15s4.19,29.53,17,42.53c16.31,17.07,37.71,16.53,47.23,18.33,34.26,3.27,145.67,4.32,145.67,4.32s90-.13,150-4.49c8.38-1,26.63-1.09,42.9-18.16,12.84-13,17-42.53,17-42.53a649,649,0,0,0,4.28-69.33V368.31A647.81,647.81,0,0,0,893.81,299ZM639.64,440.2V319.82l115.76,60.4Z" transform="translate(-469.68 -233.97)" fill="#e52d27"/></svg>',
            /**
             * Прозрачность контейнера с кнопкой
             */
            imagePlayOpacity: .85,
            /**
             * Callback функция по клику на превью
             */
            callback: function() {},
            /**
             * Параметр listType в сочетании с параметром list определяет загружаемый в проигрыватель контент.
             * Допустимые значения: playlist, search и user_uploads.
             *
             * Если вы задаете значения параметров list и listType, в URL для встраивания IFrame не нужно указывать идентификатор видео.
             */
            listType: '',
            /**
             * Параметр list в сочетании с параметром listType определяет загружаемый в проигрыватель контент.
             * Если параметр listType имеет значение search, то значение параметра list определяет поисковый запрос.
             * Если параметр listType имеет значение user_uploads, то значение параметра list определяет канал YouTube, из которого будут загружаться видео.
             * Если параметр listType имеет значение playlist, то значение параметра list определяет идентификатор плейлиста YouTube.
             * В начале идентификатора плейлиста должны стоять буквы PL, как показано ниже.
             */
            list: '',
            /**
             * Значения: 0 или 1. Значение по умолчанию: 0. Определяет, начинается ли
             * воспроизведение исходного видео сразу после загрузки проигрывателя.
             */
            autoplay: 0,
            /**
             * Значения: 1. Значение по умолчанию определяется настройками пользователя.
             * Значение 1 вызывает отображение закрытых титров по умолчанию даже в том случае,
             * если пользователь отключил титры.
             */
            cc_load_policy: 0,
            /**
             * Этот параметр определяет цвет, которым выделяется просмотренная часть видео
             * на индикаторе воспроизведения. Допустимые значения: red и white.
             * По умолчанию используется красный цвет. Дополнительные сведения о цвете можно найти в блоге YouTube API.
             * http://apiblog.youtube.com/2011/08/coming-soon-dark-player-for-embeds.html
             */
            color: 'red',
            /**
             * Значения: 0, 1 или 2. Значение по умолчанию: 1. Этот параметр определяет,
             * будут ли отображаться элементы управления проигрывателем. При встраивании IFrame
             * с загрузкой проигрывателя Flash он также определяет, когда элементы управления отображаются
             * в проигрывателе и когда загружается проигрыватель:
             *
             * controls=0 – элементы управления не отображаются в проигрывателе. При встраивании IFrame проигрыватель Flash загружается немедленно.
             * controls=1 – элементы управления отображаются в проигрывателе. При встраивании IFrame элементы управления отображаются немедленно и
             *              сразу же загружается проигрыватель Flash.
             * controls=2 – элементы управления отображаются в проигрывателе. При встраивании IFrame отображаются элементы управления, а проигрыватель
             *              Flash загружается после того, как пользователь начнет воспроизведение видео.
             *
             * Примечание. Значения параметра 1 и 2 одинаково работают с точки зрения пользователя, однако значение controls=2
             * обеспечивает увеличение производительности по сравнению со значением controls=1 при встраивании IFrame. В настоящее
             * время эти два значения все еще имеют некоторые визуальные различия в проигрывателе, такие как размер шрифта заголовка видео.
             * Однако если разница между двумя значениями станет очевидной для пользователя, значение параметра по умолчанию может измениться с 1 на 2.
             */
            controls: 1,
            /**
             * Значения: 0 или 1. Значение по умолчанию: 0. Значение 1 отключает клавиши управления проигрывателем.
             *
             * Предусмотрены следующие клавиши управления.
             * Пробел: воспроизведение/пауза
             * Стрелка влево: вернуться на 10% в текущем видео
             * Стрелка вправо: перейти на 10% вперед в текущем видео
             * Стрелка вверх: увеличить громкость
             * Стрелка вниз: уменьшить громкость
             */
            disablekb: 0,
            /**
             * Значения: 0 или 1. Значение по умолчанию: 0. Значение 1 включает API Javascript.
             * Дополнительные сведения об API Javascript и его использовании см. в документации по API JavaScript.
             */
            enablejsapi: 0,
            /**
             * Значение: положительное целое число. Этот параметр определяет время, измеряемое в секундах от начала видео,
             * когда проигрыватель должен остановить воспроизведение видео. Обратите внимание на то, что время измеряется
             * с начала видео, а не со значения параметра start или startSeconds, который используется в YouTube Player API
             * для загрузки видео или его добавления в очередь воспроизведения.
             */
            end: '',
            /**
             * Значения: 0 или 1. Значение по умолчанию 1 отображает кнопку полноэкранного режима.
             * Значение 0 скрывает кнопку полноэкранного режима.
             */
            fs: 1,
            /**
             * Определяет язык интерфейса проигрывателя. Для этого параметра используется двухбуквенный код ISO 639-1,
             * хотя такие коды языков, как теги IETF (BCP 47), также могут обрабатываться корректно.
             */
            hl: '',
            /**
             * Значения: 1 или 3. Значение по умолчанию: 1. При значении 1 аннотации видео по умолчанию будут отображаться,
             * а при значении 3 – по умолчанию будут скрыты.
             */
            iv_load_policy: 1,
            /**
             * Значения: 0 или 1. Значение по умолчанию: 0. Если значение равно 1, то одиночный проигрыватель будет
             * воспроизводить видео по кругу, в бесконечном цикле. Проигрыватель плейлистов (или пользовательский проигрыватель)
             * воспроизводит по кругу содержимое плейлиста.
             */
            loop: 0,
            /**
             * Этот параметр позволяет использовать проигрыватель YouTube, в котором не отображается логотип YouTube.
             * Установите значение 1, чтобы логотип YouTube не отображался на панели управления. Небольшая текстовая метка
             * YouTube будет отображаться в правом верхнем углу при наведении курсора на проигрыватель во время паузы
             */
            modestbranding: 0,
            /**
             * 	Этот параметр обеспечивает дополнительные меры безопасности для IFrame API и поддерживается только при встраивании IFrame.
             * 	Если вы используете IFrame API, т. е. устанавливаете для параметра enablejsapi значение 1, обязательно укажите свой домен
             * 	как значение параметра origin.
             */
            origin: '',
            /**
             * Значение представляет собой разделенный запятыми список идентификаторов видео для воспроизведения. Если вы указываете значение,
             * сначала воспроизводится видео, указанное как VIDEO_ID в URL, а затем видео, указанные в параметре playlist.
             */
            playlist: '',
            /**
             * Этот параметр определяет воспроизведение видео на странице или в полноэкранном режиме в проигрывателе HTML5 для iOS. Допустимые значения:
             * 0: воспроизведение в полноэкранном режиме. В настоящее время это значение по умолчанию, впоследствии оно может быть изменено.
             * 1: воспроизведение на странице для параметра UIWebViews, созданного с помощью свойства allowsInlineMediaPlayback со значением TRUE.
             */
            playsinline: 0,
            /**
             * Значения: 0 или 1. Значение по умолчанию: 1. Этот параметр определяет, будут ли воспроизводиться похожие видео
             * после завершения показа исходного видео.
             */
            rel: 1,
            /**
             * Значения: 0 или 1. Значение по умолчанию: 1. При значении 0 проигрыватель перед началом воспроизведения не выводит информацию о видео,
             * такую как название и автор видео.
             * Если вы устанавливаете значение 1, после загрузки плейлиста в проигрывателе отображаются значки всех видео в списке. Эта функция
             * поддерживается только в проигрывателе AS3, который позволяет загружать плейлисты.
             */
            showinfo: 1,
            /**
             * Значение: положительное целое число. Если этот параметр определен, то проигрыватель начинает воспроизведение видео с указанной секунды.
             * Обратите внимание, что, как и для функции seekTo, проигрыватель начинает воспроизведение с ключевого кадра, ближайшего к указанному
             * значению. Это означает, что в некоторых случаях воспроизведение начнется в момент, предшествующий заданному времени
             * (обычно не более чем на 2 секунды).
             */
            start: 0
        },

        /**
         * Поиск автоматического размера превью
         * @param $this
         * @param settingsEmbed
         * @returns {*}
         */
        autoSizePreview : function(containerWidth, options) {

            var isDetect = false;
            $.each({
                120  : 'default',
                320  : 'mqdefault',
                480  : 'hqdefault',
                640  : 'sddefault',
                1280 : 'maxresdefault'
            }, function(width, preview){
                if (containerWidth < width && isDetect === false) {
                    options.sizePreview = preview;
                    isDetect = true;
                }
            });

            // return options;
        },

        /**
         * Добавляем плеер в iFrame в контейнер
         * @param $this
         * @param settings
         */
        replacePlayer : function($this, options)
        {
            var query = pluginMethods.queryBuild(options);
            $this.html('<iframe src="https://www.youtube.com/embed/'+ options.id +'?'+query+'" width="100%" height="100%" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>');
            options.callback.call($this, $this.find('iframe')[0]);
        },

        /**
         * Query string
         * @param arr
         */
        queryBuild: function(options)
        {
            /* Пропустить настройки плагина, всё остальное в query */
            var skip = ['callback', 'sizePreview', 'autoSizePreview', 'alternativeCover', 'imagePlayContainer', 'imagePlayOpacity'];

            var query = [];
            $.each(options, function(key, value){
                if (skip.indexOf(key) == -1 && value !== '') {
                    query.push(key + '=' + value);
                }
            });

            return query.join('&');
        },

        /**
         * Создание контейнеров
         * @param options
         */
        init: function(options) {
            var $this = $(this),
                height = $this.height(),
                width = $this.attr('width');

            if ($this.attr('width').indexOf('%')) {
                width = $this.width();
            }

            if (height == 0) {
                height = $this.attr('height');
            }

            /* Поиск и ссылки на превью размером подходящим под наш контейнер */
            if (options.autoSizePreview && options.sizePreview == '') {
                pluginMethods.autoSizePreview(width, options);
            }

            /* Формируем ссылку на превью видео, если не указана ссылка на альтернативный */
            var previewFile = 'https://img.youtube.com/vi/'+ options.id +'/'+ options.sizePreview +'.jpg';
            if (options.alternativeCover !== false) {
                previewFile = options.alternativeCover;
            }

            /* Создаем Embed контейнер */
            $this.css({
                'background' : '#000 url('+previewFile+') center',
                'background-size' : 'cover',
                width:  width,
                height: height
            });

            /* Создаем контейнер по клику на который создадим iframe с видео */
            var $clickContainer = $('<a href="javascript:void(0);">'+options.imagePlayContainer+'</a>').css({
                display: 'flex',
                'justify-content': 'center',
                'align-items': 'center',
                width: '100%',
                height: 'inherit',
                opacity: options.imagePlayOpacity
            }).hover(function(){
                $(this).stop(true, true).animate({opacity: 1}, 170);
            }, function(){
                $(this).stop(true, true).animate({opacity: options.imagePlayOpacity}, 170);
            });

            $clickContainer.click(function(){
                $(this).animate({opacity: 0}, 80, function(){
                    pluginMethods.replacePlayer($this, options);
                    $(this).remove();
                });
            });

            $this.append($clickContainer);
        }
    };
})(jQuery);