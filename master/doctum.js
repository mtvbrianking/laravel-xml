

(function(root) {

    var bhIndex = null;
    var rootPath = '';
    var treeHtml = '<ul><li data-name="namespace:Bmatovu" class="opened"><div style="padding-left:0px" class="hd"><span class="icon icon-play"></span><a href="Bmatovu.html">Bmatovu</a></div><div class="bd"><ul><li data-name="namespace:Bmatovu_LaravelXml" class="opened"><div style="padding-left:18px" class="hd"><span class="icon icon-play"></span><a href="Bmatovu/LaravelXml.html">LaravelXml</a></div><div class="bd"><ul><li data-name="namespace:Bmatovu_LaravelXml_Http" class="opened"><div style="padding-left:36px" class="hd"><span class="icon icon-play"></span><a href="Bmatovu/LaravelXml/Http.html">Http</a></div><div class="bd"><ul><li data-name="namespace:Bmatovu_LaravelXml_Http_Middleware" ><div style="padding-left:54px" class="hd"><span class="icon icon-play"></span><a href="Bmatovu/LaravelXml/Http/Middleware.html">Middleware</a></div><div class="bd"><ul><li data-name="class:Bmatovu_LaravelXml_Http_Middleware_RequireXml" ><div style="padding-left:80px" class="hd leaf"><a href="Bmatovu/LaravelXml/Http/Middleware/RequireXml.html">RequireXml</a></div></li></ul></div></li><li data-name="class:Bmatovu_LaravelXml_Http_XmlResponse" ><div style="padding-left:62px" class="hd leaf"><a href="Bmatovu/LaravelXml/Http/XmlResponse.html">XmlResponse</a></div></li></ul></div></li><li data-name="namespace:Bmatovu_LaravelXml_Support" class="opened"><div style="padding-left:36px" class="hd"><span class="icon icon-play"></span><a href="Bmatovu/LaravelXml/Support.html">Support</a></div><div class="bd"><ul><li data-name="namespace:Bmatovu_LaravelXml_Support_Facades" ><div style="padding-left:54px" class="hd"><span class="icon icon-play"></span><a href="Bmatovu/LaravelXml/Support/Facades.html">Facades</a></div><div class="bd"><ul><li data-name="class:Bmatovu_LaravelXml_Support_Facades_LaravelXml" ><div style="padding-left:80px" class="hd leaf"><a href="Bmatovu/LaravelXml/Support/Facades/LaravelXml.html">LaravelXml</a></div></li></ul></div></li><li data-name="class:Bmatovu_LaravelXml_Support_ArrayToXml" ><div style="padding-left:62px" class="hd leaf"><a href="Bmatovu/LaravelXml/Support/ArrayToXml.html">ArrayToXml</a></div></li><li data-name="class:Bmatovu_LaravelXml_Support_JsonSimpleXMLElementDecorator" ><div style="padding-left:62px" class="hd leaf"><a href="Bmatovu/LaravelXml/Support/JsonSimpleXMLElementDecorator.html">JsonSimpleXMLElementDecorator</a></div></li><li data-name="class:Bmatovu_LaravelXml_Support_XmlElement" ><div style="padding-left:62px" class="hd leaf"><a href="Bmatovu/LaravelXml/Support/XmlElement.html">XmlElement</a></div></li><li data-name="class:Bmatovu_LaravelXml_Support_XmlValidator" ><div style="padding-left:62px" class="hd leaf"><a href="Bmatovu/LaravelXml/Support/XmlValidator.html">XmlValidator</a></div></li></ul></div></li><li data-name="class:Bmatovu_LaravelXml_LaravelXml" class="opened"><div style="padding-left:44px" class="hd leaf"><a href="Bmatovu/LaravelXml/LaravelXml.html">LaravelXml</a></div></li><li data-name="class:Bmatovu_LaravelXml_LaravelXmlServiceProvider" class="opened"><div style="padding-left:44px" class="hd leaf"><a href="Bmatovu/LaravelXml/LaravelXmlServiceProvider.html">LaravelXmlServiceProvider</a></div></li></ul></div></li></ul></div></li></ul>';

    var searchTypeClasses = {
        'Namespace': 'label-default',
        'Class': 'label-info',
        'Interface': 'label-primary',
        'Trait': 'label-success',
        'Method': 'label-danger',
        '_': 'label-warning'
    };

    var searchIndex = [
                        {"type":"Namespace","link":"Bmatovu.html","name":"Bmatovu","doc":"Namespace Bmatovu"},{"type":"Namespace","link":"Bmatovu/LaravelXml.html","name":"Bmatovu\\LaravelXml","doc":"Namespace Bmatovu\\LaravelXml"},{"type":"Namespace","link":"Bmatovu/LaravelXml/Http.html","name":"Bmatovu\\LaravelXml\\Http","doc":"Namespace Bmatovu\\LaravelXml\\Http"},{"type":"Namespace","link":"Bmatovu/LaravelXml/Http/Middleware.html","name":"Bmatovu\\LaravelXml\\Http\\Middleware","doc":"Namespace Bmatovu\\LaravelXml\\Http\\Middleware"},{"type":"Namespace","link":"Bmatovu/LaravelXml/Support.html","name":"Bmatovu\\LaravelXml\\Support","doc":"Namespace Bmatovu\\LaravelXml\\Support"},{"type":"Namespace","link":"Bmatovu/LaravelXml/Support/Facades.html","name":"Bmatovu\\LaravelXml\\Support\\Facades","doc":"Namespace Bmatovu\\LaravelXml\\Support\\Facades"},                                                        {"type":"Class","fromName":"Bmatovu\\LaravelXml\\Http\\Middleware","fromLink":"Bmatovu/LaravelXml/Http/Middleware.html","link":"Bmatovu/LaravelXml/Http/Middleware/RequireXml.html","name":"Bmatovu\\LaravelXml\\Http\\Middleware\\RequireXml","doc":null},
                                {"type":"Method","fromName":"Bmatovu\\LaravelXml\\Http\\Middleware\\RequireXml","fromLink":"Bmatovu/LaravelXml/Http/Middleware/RequireXml.html","link":"Bmatovu/LaravelXml/Http/Middleware/RequireXml.html#method_handle","name":"Bmatovu\\LaravelXml\\Http\\Middleware\\RequireXml::handle","doc":"<p>Handle an incoming request.</p>"},
            
                                                {"type":"Class","fromName":"Bmatovu\\LaravelXml\\Http","fromLink":"Bmatovu/LaravelXml/Http.html","link":"Bmatovu/LaravelXml/Http/XmlResponse.html","name":"Bmatovu\\LaravelXml\\Http\\XmlResponse","doc":null},
                                {"type":"Method","fromName":"Bmatovu\\LaravelXml\\Http\\XmlResponse","fromLink":"Bmatovu/LaravelXml/Http/XmlResponse.html","link":"Bmatovu/LaravelXml/Http/XmlResponse.html#method___construct","name":"Bmatovu\\LaravelXml\\Http\\XmlResponse::__construct","doc":"<p>Constructor.</p>"},
        {"type":"Method","fromName":"Bmatovu\\LaravelXml\\Http\\XmlResponse","fromLink":"Bmatovu/LaravelXml/Http/XmlResponse.html","link":"Bmatovu/LaravelXml/Http/XmlResponse.html#method_setContent","name":"Bmatovu\\LaravelXml\\Http\\XmlResponse::setContent","doc":"<p>Set the content on the response.</p>"},
            
                                                {"type":"Class","fromName":"Bmatovu\\LaravelXml","fromLink":"Bmatovu/LaravelXml.html","link":"Bmatovu/LaravelXml/LaravelXml.html","name":"Bmatovu\\LaravelXml\\LaravelXml","doc":null},
                                {"type":"Method","fromName":"Bmatovu\\LaravelXml\\LaravelXml","fromLink":"Bmatovu/LaravelXml/LaravelXml.html","link":"Bmatovu/LaravelXml/LaravelXml.html#method_getFacadeAccessor","name":"Bmatovu\\LaravelXml\\LaravelXml::getFacadeAccessor","doc":"<p>Get the binding in the IoC container.</p>"},
            
                                                {"type":"Class","fromName":"Bmatovu\\LaravelXml","fromLink":"Bmatovu/LaravelXml.html","link":"Bmatovu/LaravelXml/LaravelXmlServiceProvider.html","name":"Bmatovu\\LaravelXml\\LaravelXmlServiceProvider","doc":null},
                                {"type":"Method","fromName":"Bmatovu\\LaravelXml\\LaravelXmlServiceProvider","fromLink":"Bmatovu/LaravelXml/LaravelXmlServiceProvider.html","link":"Bmatovu/LaravelXml/LaravelXmlServiceProvider.html#method_boot","name":"Bmatovu\\LaravelXml\\LaravelXmlServiceProvider::boot","doc":"<p>Bootstrap the application services.</p>"},
        {"type":"Method","fromName":"Bmatovu\\LaravelXml\\LaravelXmlServiceProvider","fromLink":"Bmatovu/LaravelXml/LaravelXmlServiceProvider.html","link":"Bmatovu/LaravelXml/LaravelXmlServiceProvider.html#method_register","name":"Bmatovu\\LaravelXml\\LaravelXmlServiceProvider::register","doc":"<p>Register the application services.</p>"},
            
                                                {"type":"Class","fromName":"Bmatovu\\LaravelXml\\Support","fromLink":"Bmatovu/LaravelXml/Support.html","link":"Bmatovu/LaravelXml/Support/ArrayToXml.html","name":"Bmatovu\\LaravelXml\\Support\\ArrayToXml","doc":""},
                                {"type":"Method","fromName":"Bmatovu\\LaravelXml\\Support\\ArrayToXml","fromLink":"Bmatovu/LaravelXml/Support/ArrayToXml.html","link":"Bmatovu/LaravelXml/Support/ArrayToXml.html#method___construct","name":"Bmatovu\\LaravelXml\\Support\\ArrayToXml::__construct","doc":"<p>Construct a new instance.</p>"},
        {"type":"Method","fromName":"Bmatovu\\LaravelXml\\Support\\ArrayToXml","fromLink":"Bmatovu/LaravelXml/Support/ArrayToXml.html","link":"Bmatovu/LaravelXml/Support/ArrayToXml.html#method_convert","name":"Bmatovu\\LaravelXml\\Support\\ArrayToXml::convert","doc":"<p>Convert the given array to an xml string.</p>"},
        {"type":"Method","fromName":"Bmatovu\\LaravelXml\\Support\\ArrayToXml","fromLink":"Bmatovu/LaravelXml/Support/ArrayToXml.html","link":"Bmatovu/LaravelXml/Support/ArrayToXml.html#method_toXml","name":"Bmatovu\\LaravelXml\\Support\\ArrayToXml::toXml","doc":"<p>Return as XML.</p>"},
        {"type":"Method","fromName":"Bmatovu\\LaravelXml\\Support\\ArrayToXml","fromLink":"Bmatovu/LaravelXml/Support/ArrayToXml.html","link":"Bmatovu/LaravelXml/Support/ArrayToXml.html#method_toDom","name":"Bmatovu\\LaravelXml\\Support\\ArrayToXml::toDom","doc":"<p>Return as DOM object.</p>"},
        {"type":"Method","fromName":"Bmatovu\\LaravelXml\\Support\\ArrayToXml","fromLink":"Bmatovu/LaravelXml/Support/ArrayToXml.html","link":"Bmatovu/LaravelXml/Support/ArrayToXml.html#method_addNode","name":"Bmatovu\\LaravelXml\\Support\\ArrayToXml::addNode","doc":"<p>Add node.</p>"},
        {"type":"Method","fromName":"Bmatovu\\LaravelXml\\Support\\ArrayToXml","fromLink":"Bmatovu/LaravelXml/Support/ArrayToXml.html","link":"Bmatovu/LaravelXml/Support/ArrayToXml.html#method_addCollectionNode","name":"Bmatovu\\LaravelXml\\Support\\ArrayToXml::addCollectionNode","doc":"<p>Add collection node.</p>"},
        {"type":"Method","fromName":"Bmatovu\\LaravelXml\\Support\\ArrayToXml","fromLink":"Bmatovu/LaravelXml/Support/ArrayToXml.html","link":"Bmatovu/LaravelXml/Support/ArrayToXml.html#method_addSequentialNode","name":"Bmatovu\\LaravelXml\\Support\\ArrayToXml::addSequentialNode","doc":"<p>Add sequential node.</p>"},
        {"type":"Method","fromName":"Bmatovu\\LaravelXml\\Support\\ArrayToXml","fromLink":"Bmatovu/LaravelXml/Support/ArrayToXml.html","link":"Bmatovu/LaravelXml/Support/ArrayToXml.html#method_isArrayAllKeySequential","name":"Bmatovu\\LaravelXml\\Support\\ArrayToXml::isArrayAllKeySequential","doc":"<p>Check if array are all sequential.</p>"},
        {"type":"Method","fromName":"Bmatovu\\LaravelXml\\Support\\ArrayToXml","fromLink":"Bmatovu/LaravelXml/Support/ArrayToXml.html","link":"Bmatovu/LaravelXml/Support/ArrayToXml.html#method_addAttributes","name":"Bmatovu\\LaravelXml\\Support\\ArrayToXml::addAttributes","doc":"<p>Add attributes.</p>"},
        {"type":"Method","fromName":"Bmatovu\\LaravelXml\\Support\\ArrayToXml","fromLink":"Bmatovu/LaravelXml/Support/ArrayToXml.html","link":"Bmatovu/LaravelXml/Support/ArrayToXml.html#method_createRootElement","name":"Bmatovu\\LaravelXml\\Support\\ArrayToXml::createRootElement","doc":"<p>Create the root element.</p>"},
        {"type":"Method","fromName":"Bmatovu\\LaravelXml\\Support\\ArrayToXml","fromLink":"Bmatovu/LaravelXml/Support/ArrayToXml.html","link":"Bmatovu/LaravelXml/Support/ArrayToXml.html#method_convertElement","name":"Bmatovu\\LaravelXml\\Support\\ArrayToXml::convertElement","doc":"<p>Parse individual element.</p>"},
            
                                                {"type":"Class","fromName":"Bmatovu\\LaravelXml\\Support\\Facades","fromLink":"Bmatovu/LaravelXml/Support/Facades.html","link":"Bmatovu/LaravelXml/Support/Facades/LaravelXml.html","name":"Bmatovu\\LaravelXml\\Support\\Facades\\LaravelXml","doc":null},
                                {"type":"Method","fromName":"Bmatovu\\LaravelXml\\Support\\Facades\\LaravelXml","fromLink":"Bmatovu/LaravelXml/Support/Facades/LaravelXml.html","link":"Bmatovu/LaravelXml/Support/Facades/LaravelXml.html#method___construct","name":"Bmatovu\\LaravelXml\\Support\\Facades\\LaravelXml::__construct","doc":null},
        {"type":"Method","fromName":"Bmatovu\\LaravelXml\\Support\\Facades\\LaravelXml","fromLink":"Bmatovu/LaravelXml/Support/Facades/LaravelXml.html","link":"Bmatovu/LaravelXml/Support/Facades/LaravelXml.html#method_encode","name":"Bmatovu\\LaravelXml\\Support\\Facades\\LaravelXml::encode","doc":"<p>Convert the an array to an xml string.</p>"},
        {"type":"Method","fromName":"Bmatovu\\LaravelXml\\Support\\Facades\\LaravelXml","fromLink":"Bmatovu/LaravelXml/Support/Facades/LaravelXml.html","link":"Bmatovu/LaravelXml/Support/Facades/LaravelXml.html#method_decode","name":"Bmatovu\\LaravelXml\\Support\\Facades\\LaravelXml::decode","doc":"<p>Convert a string of XML into an array.</p>"},
        {"type":"Method","fromName":"Bmatovu\\LaravelXml\\Support\\Facades\\LaravelXml","fromLink":"Bmatovu/LaravelXml/Support/Facades/LaravelXml.html","link":"Bmatovu/LaravelXml/Support/Facades/LaravelXml.html#method_is_valid","name":"Bmatovu\\LaravelXml\\Support\\Facades\\LaravelXml::is_valid","doc":"<p>Check if a string is valid XML.</p>"},
        {"type":"Method","fromName":"Bmatovu\\LaravelXml\\Support\\Facades\\LaravelXml","fromLink":"Bmatovu/LaravelXml/Support/Facades/LaravelXml.html","link":"Bmatovu/LaravelXml/Support/Facades/LaravelXml.html#method_validate","name":"Bmatovu\\LaravelXml\\Support\\Facades\\LaravelXml::validate","doc":"<p>Validate XML string.</p>"},
            
                                                {"type":"Class","fromName":"Bmatovu\\LaravelXml\\Support","fromLink":"Bmatovu/LaravelXml/Support.html","link":"Bmatovu/LaravelXml/Support/JsonSimpleXMLElementDecorator.html","name":"Bmatovu\\LaravelXml\\Support\\JsonSimpleXMLElementDecorator","doc":"<p>Class JsonSimpleXMLElementDecorator.</p>"},
                                {"type":"Method","fromName":"Bmatovu\\LaravelXml\\Support\\JsonSimpleXMLElementDecorator","fromLink":"Bmatovu/LaravelXml/Support/JsonSimpleXMLElementDecorator.html","link":"Bmatovu/LaravelXml/Support/JsonSimpleXMLElementDecorator.html#method___construct","name":"Bmatovu\\LaravelXml\\Support\\JsonSimpleXMLElementDecorator::__construct","doc":"<p>Constructor.</p>"},
        {"type":"Method","fromName":"Bmatovu\\LaravelXml\\Support\\JsonSimpleXMLElementDecorator","fromLink":"Bmatovu/LaravelXml/Support/JsonSimpleXMLElementDecorator.html","link":"Bmatovu/LaravelXml/Support/JsonSimpleXMLElementDecorator.html#method_useAttributes","name":"Bmatovu\\LaravelXml\\Support\\JsonSimpleXMLElementDecorator::useAttributes","doc":"<p>Should use attributes.</p>"},
        {"type":"Method","fromName":"Bmatovu\\LaravelXml\\Support\\JsonSimpleXMLElementDecorator","fromLink":"Bmatovu/LaravelXml/Support/JsonSimpleXMLElementDecorator.html","link":"Bmatovu/LaravelXml/Support/JsonSimpleXMLElementDecorator.html#method_useText","name":"Bmatovu\\LaravelXml\\Support\\JsonSimpleXMLElementDecorator::useText","doc":"<p>Should use text.</p>"},
        {"type":"Method","fromName":"Bmatovu\\LaravelXml\\Support\\JsonSimpleXMLElementDecorator","fromLink":"Bmatovu/LaravelXml/Support/JsonSimpleXMLElementDecorator.html","link":"Bmatovu/LaravelXml/Support/JsonSimpleXMLElementDecorator.html#method_setDepth","name":"Bmatovu\\LaravelXml\\Support\\JsonSimpleXMLElementDecorator::setDepth","doc":"<p>Set depth.</p>"},
        {"type":"Method","fromName":"Bmatovu\\LaravelXml\\Support\\JsonSimpleXMLElementDecorator","fromLink":"Bmatovu/LaravelXml/Support/JsonSimpleXMLElementDecorator.html","link":"Bmatovu/LaravelXml/Support/JsonSimpleXMLElementDecorator.html#method_jsonSerialize","name":"Bmatovu\\LaravelXml\\Support\\JsonSimpleXMLElementDecorator::jsonSerialize","doc":"<p>Specify data which should be serialized to JSON.</p>"},
            
                                                {"type":"Class","fromName":"Bmatovu\\LaravelXml\\Support","fromLink":"Bmatovu/LaravelXml/Support.html","link":"Bmatovu/LaravelXml/Support/XmlElement.html","name":"Bmatovu\\LaravelXml\\Support\\XmlElement","doc":null},
                                {"type":"Method","fromName":"Bmatovu\\LaravelXml\\Support\\XmlElement","fromLink":"Bmatovu/LaravelXml/Support/XmlElement.html","link":"Bmatovu/LaravelXml/Support/XmlElement.html#method_get","name":"Bmatovu\\LaravelXml\\Support\\XmlElement::get","doc":"<p>Provides access to element's children.</p>"},
            
                                                {"type":"Class","fromName":"Bmatovu\\LaravelXml\\Support","fromLink":"Bmatovu/LaravelXml/Support.html","link":"Bmatovu/LaravelXml/Support/XmlValidator.html","name":"Bmatovu\\LaravelXml\\Support\\XmlValidator","doc":"<p>Class XmlValidator.</p>"},
                                {"type":"Method","fromName":"Bmatovu\\LaravelXml\\Support\\XmlValidator","fromLink":"Bmatovu/LaravelXml/Support/XmlValidator.html","link":"Bmatovu/LaravelXml/Support/XmlValidator.html#method___construct","name":"Bmatovu\\LaravelXml\\Support\\XmlValidator::__construct","doc":"<p>Constructor.</p>"},
        {"type":"Method","fromName":"Bmatovu\\LaravelXml\\Support\\XmlValidator","fromLink":"Bmatovu/LaravelXml/Support/XmlValidator.html","link":"Bmatovu/LaravelXml/Support/XmlValidator.html#method_is_valid","name":"Bmatovu\\LaravelXml\\Support\\XmlValidator::is_valid","doc":"<p>Check if a string is valid XML.</p>"},
        {"type":"Method","fromName":"Bmatovu\\LaravelXml\\Support\\XmlValidator","fromLink":"Bmatovu/LaravelXml/Support/XmlValidator.html","link":"Bmatovu/LaravelXml/Support/XmlValidator.html#method_validate","name":"Bmatovu\\LaravelXml\\Support\\XmlValidator::validate","doc":"<p>Validate XML string.</p>"},
        {"type":"Method","fromName":"Bmatovu\\LaravelXml\\Support\\XmlValidator","fromLink":"Bmatovu/LaravelXml/Support/XmlValidator.html","link":"Bmatovu/LaravelXml/Support/XmlValidator.html#method_getElement","name":"Bmatovu\\LaravelXml\\Support\\XmlValidator::getElement","doc":"<p>Get element from message.</p>"},
        {"type":"Method","fromName":"Bmatovu\\LaravelXml\\Support\\XmlValidator","fromLink":"Bmatovu/LaravelXml/Support/XmlValidator.html","link":"Bmatovu/LaravelXml/Support/XmlValidator.html#method_getMessage","name":"Bmatovu\\LaravelXml\\Support\\XmlValidator::getMessage","doc":"<p>Get refined message.</p>"},
            
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

    root.Doctum = {
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
        Doctum.injectApiTree($('#api-tree'));
    });

    return root.Doctum;
})(window);

$(function() {

        // Enable the version switcher
    $('#version-switcher').on('change', function() {
        window.location = $(this).val()
    });
    var versionSwitcher = document.getElementById('version-switcher');
    if (versionSwitcher) {
        var versionToSelect = document.evaluate(
            '//option[@data-version="master"]',
            versionSwitcher,
            null,
            XPathResult.FIRST_ORDERED_NODE_TYPE,
            null
        ).singleNodeValue;

        if (versionToSelect && typeof versionToSelect.selected === 'boolean') {
            versionToSelect.selected = true;
        }
    }
    
    
        // Toggle left-nav divs on click
        $('#api-tree .hd span').on('click', function() {
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
                cb(Doctum.search(q));
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


