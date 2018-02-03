
window.projectVersion = 'master';

(function(root) {

    var bhIndex = null;
    var rootPath = '';
    var treeHtml = '        <ul>                <li data-name="namespace:Filesystem" class="opened">                    <div style="padding-left:0px" class="hd">                        <span class="glyphicon glyphicon-play"></span><a href="Filesystem.html">Filesystem</a>                    </div>                    <div class="bd">                                <ul>                <li data-name="class:Filesystem_Archive" class="opened">                    <div style="padding-left:26px" class="hd leaf">                        <a href="Filesystem/Archive.html">Archive</a>                    </div>                </li>                            <li data-name="class:Filesystem_Builder" class="opened">                    <div style="padding-left:26px" class="hd leaf">                        <a href="Filesystem/Builder.html">Builder</a>                    </div>                </li>                            <li data-name="class:Filesystem_Filesystem" class="opened">                    <div style="padding-left:26px" class="hd leaf">                        <a href="Filesystem/Filesystem.html">Filesystem</a>                    </div>                </li>                            <li data-name="class:Filesystem_Subprocess" class="opened">                    <div style="padding-left:26px" class="hd leaf">                        <a href="Filesystem/Subprocess.html">Subprocess</a>                    </div>                </li>                </ul></div>                </li>                </ul>';

    var searchTypeClasses = {
        'Namespace': 'label-default',
        'Class': 'label-info',
        'Interface': 'label-primary',
        'Trait': 'label-success',
        'Method': 'label-danger',
        '_': 'label-warning'
    };

    var searchIndex = [
                    
            {"type": "Namespace", "link": "Filesystem.html", "name": "Filesystem", "doc": "Namespace Filesystem"},
            
            {"type": "Class", "fromName": "Filesystem", "fromLink": "Filesystem.html", "link": "Filesystem/Archive.html", "name": "Filesystem\\Archive", "doc": "&quot;Archive class.&quot;"},
                                                        {"type": "Method", "fromName": "Filesystem\\Archive", "fromLink": "Filesystem/Archive.html", "link": "Filesystem/Archive.html#method___construct", "name": "Filesystem\\Archive::__construct", "doc": "&quot;Constructor.&quot;"},
                    {"type": "Method", "fromName": "Filesystem\\Archive", "fromLink": "Filesystem/Archive.html", "link": "Filesystem/Archive.html#method___toString", "name": "Filesystem\\Archive::__toString", "doc": "&quot;Convert object of class to string.&quot;"},
                    {"type": "Method", "fromName": "Filesystem\\Archive", "fromLink": "Filesystem/Archive.html", "link": "Filesystem/Archive.html#method_add_files", "name": "Filesystem\\Archive::add_files", "doc": "&quot;Add files to archive file.&quot;"},
                    {"type": "Method", "fromName": "Filesystem\\Archive", "fromLink": "Filesystem/Archive.html", "link": "Filesystem/Archive.html#method_get_files", "name": "Filesystem\\Archive::get_files", "doc": "&quot;Returns files to be added to archive file.&quot;"},
                    {"type": "Method", "fromName": "Filesystem\\Archive", "fromLink": "Filesystem/Archive.html", "link": "Filesystem/Archive.html#method_zipinfo", "name": "Filesystem\\Archive::zipinfo", "doc": "&quot;Returns archive file info (zip).&quot;"},
                    {"type": "Method", "fromName": "Filesystem\\Archive", "fromLink": "Filesystem/Archive.html", "link": "Filesystem/Archive.html#method_zip", "name": "Filesystem\\Archive::zip", "doc": "&quot;Create archive file (zip).&quot;"},
                    {"type": "Method", "fromName": "Filesystem\\Archive", "fromLink": "Filesystem/Archive.html", "link": "Filesystem/Archive.html#method_unzip", "name": "Filesystem\\Archive::unzip", "doc": "&quot;Extract archive file (zip).&quot;"},
                    {"type": "Method", "fromName": "Filesystem\\Archive", "fromLink": "Filesystem/Archive.html", "link": "Filesystem/Archive.html#method_tar", "name": "Filesystem\\Archive::tar", "doc": "&quot;Create archive file (tar).&quot;"},
                    {"type": "Method", "fromName": "Filesystem\\Archive", "fromLink": "Filesystem/Archive.html", "link": "Filesystem/Archive.html#method_xz", "name": "Filesystem\\Archive::xz", "doc": "&quot;Compresses archive file (xz).&quot;"},
                    {"type": "Method", "fromName": "Filesystem\\Archive", "fromLink": "Filesystem/Archive.html", "link": "Filesystem/Archive.html#method_run", "name": "Filesystem\\Archive::run", "doc": "&quot;Executes archive command.&quot;"},
            
            {"type": "Class", "fromName": "Filesystem", "fromLink": "Filesystem.html", "link": "Filesystem/Builder.html", "name": "Filesystem\\Builder", "doc": "&quot;Builder class.&quot;"},
                                                        {"type": "Method", "fromName": "Filesystem\\Builder", "fromLink": "Filesystem/Builder.html", "link": "Filesystem/Builder.html#method___toString", "name": "Filesystem\\Builder::__toString", "doc": "&quot;Returns $command as string.&quot;"},
                    {"type": "Method", "fromName": "Filesystem\\Builder", "fromLink": "Filesystem/Builder.html", "link": "Filesystem/Builder.html#method_setPrefix", "name": "Filesystem\\Builder::setPrefix", "doc": "&quot;Set command line prefix.&quot;"},
                    {"type": "Method", "fromName": "Filesystem\\Builder", "fromLink": "Filesystem/Builder.html", "link": "Filesystem/Builder.html#method_setOptions", "name": "Filesystem\\Builder::setOptions", "doc": "&quot;Set command line options&quot;"},
                    {"type": "Method", "fromName": "Filesystem\\Builder", "fromLink": "Filesystem/Builder.html", "link": "Filesystem/Builder.html#method_setArguments", "name": "Filesystem\\Builder::setArguments", "doc": "&quot;Set command line arguments&quot;"},
            
            {"type": "Class", "fromName": "Filesystem", "fromLink": "Filesystem.html", "link": "Filesystem/Filesystem.html", "name": "Filesystem\\Filesystem", "doc": "&quot;&quot;"},
                                                        {"type": "Method", "fromName": "Filesystem\\Filesystem", "fromLink": "Filesystem/Filesystem.html", "link": "Filesystem/Filesystem.html#method_chmod", "name": "Filesystem\\Filesystem::chmod", "doc": "&quot;Changes mode for files\/directories.&quot;"},
                    {"type": "Method", "fromName": "Filesystem\\Filesystem", "fromLink": "Filesystem/Filesystem.html", "link": "Filesystem/Filesystem.html#method_chgrp", "name": "Filesystem\\Filesystem::chgrp", "doc": "&quot;Changes group of file.&quot;"},
                    {"type": "Method", "fromName": "Filesystem\\Filesystem", "fromLink": "Filesystem/Filesystem.html", "link": "Filesystem/Filesystem.html#method_copy", "name": "Filesystem\\Filesystem::copy", "doc": "&quot;Copies file.&quot;"},
                    {"type": "Method", "fromName": "Filesystem\\Filesystem", "fromLink": "Filesystem/Filesystem.html", "link": "Filesystem/Filesystem.html#method_delete", "name": "Filesystem\\Filesystem::delete", "doc": "&quot;Removes file.&quot;"},
                    {"type": "Method", "fromName": "Filesystem\\Filesystem", "fromLink": "Filesystem/Filesystem.html", "link": "Filesystem/Filesystem.html#method_deleteFiles", "name": "Filesystem\\Filesystem::deleteFiles", "doc": "&quot;Removes files.&quot;"},
                    {"type": "Method", "fromName": "Filesystem\\Filesystem", "fromLink": "Filesystem/Filesystem.html", "link": "Filesystem/Filesystem.html#method_glob", "name": "Filesystem\\Filesystem::glob", "doc": "&quot;Returns pathnames matching a pattern (for files only &amp;amp; hidden files).&quot;"},
                    {"type": "Method", "fromName": "Filesystem\\Filesystem", "fromLink": "Filesystem/Filesystem.html", "link": "Filesystem/Filesystem.html#method_mkdir", "name": "Filesystem\\Filesystem::mkdir", "doc": "&quot;Create new directory.&quot;"},
                    {"type": "Method", "fromName": "Filesystem\\Filesystem", "fromLink": "Filesystem/Filesystem.html", "link": "Filesystem/Filesystem.html#method_mkdirs", "name": "Filesystem\\Filesystem::mkdirs", "doc": "&quot;Create new directories.&quot;"},
                    {"type": "Method", "fromName": "Filesystem\\Filesystem", "fromLink": "Filesystem/Filesystem.html", "link": "Filesystem/Filesystem.html#method_rmdir", "name": "Filesystem\\Filesystem::rmdir", "doc": "&quot;Removes a directory.&quot;"},
                    {"type": "Method", "fromName": "Filesystem\\Filesystem", "fromLink": "Filesystem/Filesystem.html", "link": "Filesystem/Filesystem.html#method_rmdirs", "name": "Filesystem\\Filesystem::rmdirs", "doc": "&quot;Removes a directories.&quot;"},
                    {"type": "Method", "fromName": "Filesystem\\Filesystem", "fromLink": "Filesystem/Filesystem.html", "link": "Filesystem/Filesystem.html#method_rename", "name": "Filesystem\\Filesystem::rename", "doc": "&quot;Moves file to different path (rename).&quot;"},
                    {"type": "Method", "fromName": "Filesystem\\Filesystem", "fromLink": "Filesystem/Filesystem.html", "link": "Filesystem/Filesystem.html#method_tmpfile", "name": "Filesystem\\Filesystem::tmpfile", "doc": "&quot;Create temporary file.&quot;"},
                    {"type": "Method", "fromName": "Filesystem\\Filesystem", "fromLink": "Filesystem/Filesystem.html", "link": "Filesystem/Filesystem.html#method_tmpdir", "name": "Filesystem\\Filesystem::tmpdir", "doc": "&quot;Create temporary directory.&quot;"},
                    {"type": "Method", "fromName": "Filesystem\\Filesystem", "fromLink": "Filesystem/Filesystem.html", "link": "Filesystem/Filesystem.html#method_dirExists", "name": "Filesystem\\Filesystem::dirExists", "doc": "&quot;Checks if directory exists;.&quot;"},
                    {"type": "Method", "fromName": "Filesystem\\Filesystem", "fromLink": "Filesystem/Filesystem.html", "link": "Filesystem/Filesystem.html#method_fileExists", "name": "Filesystem\\Filesystem::fileExists", "doc": "&quot;Checks if file exists;.&quot;"},
            
            {"type": "Class", "fromName": "Filesystem", "fromLink": "Filesystem.html", "link": "Filesystem/Subprocess.html", "name": "Filesystem\\Subprocess", "doc": "&quot;Subprocess class.&quot;"},
                                                        {"type": "Method", "fromName": "Filesystem\\Subprocess", "fromLink": "Filesystem/Subprocess.html", "link": "Filesystem/Subprocess.html#method_run", "name": "Filesystem\\Subprocess::run", "doc": "&quot;Initiate subprocess.&quot;"},
                    {"type": "Method", "fromName": "Filesystem\\Subprocess", "fromLink": "Filesystem/Subprocess.html", "link": "Filesystem/Subprocess.html#method_stream_to_file", "name": "Filesystem\\Subprocess::stream_to_file", "doc": "&quot;Stream STDOUT and\/or STDERR to console.&quot;"},
                    {"type": "Method", "fromName": "Filesystem\\Subprocess", "fromLink": "Filesystem/Subprocess.html", "link": "Filesystem/Subprocess.html#method_stream_to_stdout", "name": "Filesystem\\Subprocess::stream_to_stdout", "doc": "&quot;Stream STDOUT and STDERR to console.&quot;"},
                    {"type": "Method", "fromName": "Filesystem\\Subprocess", "fromLink": "Filesystem/Subprocess.html", "link": "Filesystem/Subprocess.html#method_stream_to_both", "name": "Filesystem\\Subprocess::stream_to_both", "doc": "&quot;Stream STDOUT and STDERR to console.&quot;"},
                    {"type": "Method", "fromName": "Filesystem\\Subprocess", "fromLink": "Filesystem/Subprocess.html", "link": "Filesystem/Subprocess.html#method_stream_stdout_wait", "name": "Filesystem\\Subprocess::stream_stdout_wait", "doc": "&quot;Wait for process to finish and return.&quot;"},
                    {"type": "Method", "fromName": "Filesystem\\Subprocess", "fromLink": "Filesystem/Subprocess.html", "link": "Filesystem/Subprocess.html#method_stream_stdout_tty", "name": "Filesystem\\Subprocess::stream_stdout_tty", "doc": "&quot;Stream STDOUT and STDERR to console (interactive mode).&quot;"},
                    {"type": "Method", "fromName": "Filesystem\\Subprocess", "fromLink": "Filesystem/Subprocess.html", "link": "Filesystem/Subprocess.html#method_get_process_info", "name": "Filesystem\\Subprocess::get_process_info", "doc": "&quot;Returns process information.&quot;"},
            
            
                                        // Fix trailing commas in the index
        {}
    ];

    /** Tokenizes strings by namespaces and functions */
    function tokenizer(term) {
        if (!term) {
            return [];
        }

        var tokens = [term];
        var meth = term.indexOf('::');

        // Split tokens into methods if "::" is found.
        if (meth > -1) {
            tokens.push(term.substr(meth + 2));
            term = term.substr(0, meth - 2);
        }

        // Split by namespace or fake namespace.
        if (term.indexOf('\\') > -1) {
            tokens = tokens.concat(term.split('\\'));
        } else if (term.indexOf('_') > 0) {
            tokens = tokens.concat(term.split('_'));
        }

        // Merge in splitting the string by case and return
        tokens = tokens.concat(term.match(/(([A-Z]?[^A-Z]*)|([a-z]?[^a-z]*))/g).slice(0,-1));

        return tokens;
    };

    root.Sami = {
        /**
         * Cleans the provided term. If no term is provided, then one is
         * grabbed from the query string "search" parameter.
         */
        cleanSearchTerm: function(term) {
            // Grab from the query string
            if (typeof term === 'undefined') {
                var name = 'search';
                var regex = new RegExp("[\\?&]" + name + "=([^&#]*)");
                var results = regex.exec(location.search);
                if (results === null) {
                    return null;
                }
                term = decodeURIComponent(results[1].replace(/\+/g, " "));
            }

            return term.replace(/<(?:.|\n)*?>/gm, '');
        },

        /** Searches through the index for a given term */
        search: function(term) {
            // Create a new search index if needed
            if (!bhIndex) {
                bhIndex = new Bloodhound({
                    limit: 500,
                    local: searchIndex,
                    datumTokenizer: function (d) {
                        return tokenizer(d.name);
                    },
                    queryTokenizer: Bloodhound.tokenizers.whitespace
                });
                bhIndex.initialize();
            }

            results = [];
            bhIndex.get(term, function(matches) {
                results = matches;
            });

            if (!rootPath) {
                return results;
            }

            // Fix the element links based on the current page depth.
            return $.map(results, function(ele) {
                if (ele.link.indexOf('..') > -1) {
                    return ele;
                }
                ele.link = rootPath + ele.link;
                if (ele.fromLink) {
                    ele.fromLink = rootPath + ele.fromLink;
                }
                return ele;
            });
        },

        /** Get a search class for a specific type */
        getSearchClass: function(type) {
            return searchTypeClasses[type] || searchTypeClasses['_'];
        },

        /** Add the left-nav tree to the site */
        injectApiTree: function(ele) {
            ele.html(treeHtml);
        }
    };

    $(function() {
        // Modify the HTML to work correctly based on the current depth
        rootPath = $('body').attr('data-root-path');
        treeHtml = treeHtml.replace(/href="/g, 'href="' + rootPath);
        Sami.injectApiTree($('#api-tree'));
    });

    return root.Sami;
})(window);

$(function() {

    // Enable the version switcher
    $('#version-switcher').change(function() {
        window.location = $(this).val()
    });

    
        // Toggle left-nav divs on click
        $('#api-tree .hd span').click(function() {
            $(this).parent().parent().toggleClass('opened');
        });

        // Expand the parent namespaces of the current page.
        var expected = $('body').attr('data-name');

        if (expected) {
            // Open the currently selected node and its parents.
            var container = $('#api-tree');
            var node = $('#api-tree li[data-name="' + expected + '"]');
            // Node might not be found when simulating namespaces
            if (node.length > 0) {
                node.addClass('active').addClass('opened');
                node.parents('li').addClass('opened');
                var scrollPos = node.offset().top - container.offset().top + container.scrollTop();
                // Position the item nearer to the top of the screen.
                scrollPos -= 200;
                container.scrollTop(scrollPos);
            }
        }

    
    
        var form = $('#search-form .typeahead');
        form.typeahead({
            hint: true,
            highlight: true,
            minLength: 1
        }, {
            name: 'search',
            displayKey: 'name',
            source: function (q, cb) {
                cb(Sami.search(q));
            }
        });

        // The selection is direct-linked when the user selects a suggestion.
        form.on('typeahead:selected', function(e, suggestion) {
            window.location = suggestion.link;
        });

        // The form is submitted when the user hits enter.
        form.keypress(function (e) {
            if (e.which == 13) {
                $('#search-form').submit();
                return true;
            }
        });

    
});


