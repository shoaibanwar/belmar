var UA = navigator.userAgent.toLowerCase();
var isIE = (UA.indexOf("msie") >= 0) ? true : false;
var isNS = (UA.indexOf("mozilla") >= 0) ? true : false;
var isIE9 = (UA.indexOf("msie 9.0") >= 0) ? true : false;
var oUtil = new InnovaEditorUtil();

function InnovaEditorUtil() {
    this.langDir = "en-US";
    try {
        if (LanguageDirectory) {
            this.langDir = LanguageDirectory
        }
    } catch (d) {}
    var a = document.getElementsByTagName("script");
    for (var c = 0; c < a.length; c++) {
        var b = a[c].src.toLowerCase();
        if (b.indexOf("scripts/editor.js") != -1) {
            this.scriptPath = a[c].src.replace(/editor.js/ig, "")
        }
    }
    this.scriptPathLang = this.scriptPath + "language/" + this.langDir + "/";
    if (this.langDir == "en-US") {
        document.write("<script src='" + this.scriptPathLang + "editor_lang.js'><\/script>")
    }
    this.oName;
    this.oEditor;
    this.obj;
    this.oSel;
    this.sType;
    this.bInside = bInside;
    this.useSelection = true;
    this.arrEditor = [];
    this.onSelectionChanged = function () {
        return true
    };
    this.activeElement;
    this.activeModalWin;
    this.spcCharCode = [
        [169, "&copy;"],
        [163, "&pound;"],
        [174, "&reg;"],
        [233, "&eacute;"],
        [201, "&Eacute;"],
        [8364, "&euro;"],
        [8220, '"']
    ];
    this.spcChar = [];
    for (var c = 0; c < this.spcCharCode.length; c++) {
        this.spcChar[c] = [new RegExp(String.fromCharCode(this.spcCharCode[c][0]), "g"), this.spcCharCode[c][1]]
    }
    this.replaceSpecialChar = function (g) {
        for (var e = 0; e < this.spcChar.length; e++) {
            g = g.replace(this.spcChar[e][0], this.spcChar[e][1])
        }
        return g
    };
    this.initializeEditor = function (h, e) {
        var n = [],
            m, g;
        if (typeof (h) == "object" && h.tagName && h.tagName == "TEXTAREA") {
            n[0] = h
        } else {
            if (h.substr(0, 1) == "#") {
                m = document.getElementById(h.substr(1));
                if (!m) {
                    return
                }
                n[0] = m
            } else {
                var p = document.getElementsByTagName("TEXTAREA");
                for (var l = 0; l < p.length; l++) {
                    if (p[l].className == h) {
                        n[n.length] = p[l]
                    }
                }
            }
        }
        for (var l = 0; l < n.length; l++) {
            m = n[l];
            if (m.id || m.id == "") {
                m.id = "editorarea" + l
            }
            g = document.createElement("DIV");
            g.id = "innovaeditor" + l;
            m.parentNode.insertBefore(g, m);
            window["oEdit" + l] = new InnovaEditor("oEdit" + l);
            var o;
            if (window.getComputedStyle) {
                o = window.getComputedStyle(m, null)
            } else {
                if (m.currentStyle) {
                    o = m.currentStyle
                } else {
                    o = {
                        width: window["oEdit" + l].width,
                        height: window["oEdit" + l].height
                    }
                }
            }
            window["oEdit" + l].width = o.width;
            window["oEdit" + l].height = o.height;
            if (e) {
                for (var k in e) {
                    window["oEdit" + l][k] = e[k]
                }
            }
            window["oEdit" + l].REPLACE(m.id, "innovaeditor" + l)
        }
    }
}function bInside(a) {
    while (a != null) {
        if (a.contentEditable == "true") {
            return true
        }
        a = a.parentElement
    }
    return false
}function checkFocus() {
    var a = eval("idContent" + this.oName);
    var b = a.document.selection.createRange();
    var c = a.document.selection.type;
    if (b.parentElement != null) {
        if (!bInside(b.parentElement())) {
            return false
        }
    } else {
        if (!bInside(b.item(0))) {
            return false
        }
    }
    return true
}function iwe_focus() {
    var a = eval("idContent" + this.oName);
    a.focus()
}function set_focus(a) {
    var b = eval("idContent" + this.oName);
    b.focus();
    try {
        if (this.rangeBookmark != null) {
            var c = b.document.selection;
            var d = c.createRange();
            var f = this.rangeBookmark;
            if (f.parentElement()) {
                d.moveToElementText(f.parentElement());
                d.setEndPoint("StarttoStart", f);
                d.setEndPoint("EndToEnd", f);
                d.select()
            }
            if (a) {
                d.moveToElementText(b.document.body);
                d.select();
                if (a == "start") {
                    d.collapse()
                } else {
                    if (a == "end") {
                        d.collapse(false)
                    }
                }
                d.select()
            }
        } else {
            if (this.controlBookmark != null) {
                var c = b.document.body.createControlRange();
                c.add(this.controlBookmark);
                c.select()
            }
        }
    } catch (e) {}
}function bookmark_selection() {
    var a = eval("idContent" + this.oName);
    var b = a.document.selection;
    var c = b.createRange();
    if (b.type == "None" || b.type == "Text") {
        this.rangeBookmark = c;
        this.controlBookmark = null
    } else {
        this.controlBookmark = c.item(0);
        this.rangeBookmark = null
    }
}function InnovaEditor(e) {
    this.oName = e;
    this.RENDER = RENDER;
    this.init = initISEditor;
    this.IsSecurityRestricted = false;
    this.loadHTML = loadHTML;
    this.putHTML = putHTML;
    this.getHTMLBody = getHTMLBody;
    this.getXHTMLBody = getXHTMLBody;
    this.getHTML = getHTML;
    this.getXHTML = getXHTML;
    this.getTextBody = getTextBody;
    this.initialRefresh = false;
    this.preserveSpace = false;
    this.bInside = bInside;
    this.checkFocus = checkFocus;
    this.focus = iwe_focus;
    this.setFocus = set_focus;
    this.bookmarkSelection = bookmark_selection;
    this.onKeyPress = function () {
        return true
    };
    this.styleSelectionHoverBg = "#cccccc";
    this.styleSelectionHoverFg = "white";
    this.cleanEmptySpan = cleanEmptySpan;
    this.cleanFonts = cleanFonts;
    this.cleanTags = cleanTags;
    this.replaceTags = replaceTags;
    this.cleanDeprecated = cleanDeprecated;
    this.doClean = doClean;
    this.applySpanStyle = applySpanStyle;
    this.applyLine = applyLine;
    this.applyBold = applyBold;
    this.applyItalic = applyItalic;
    this.doOnPaste = doOnPaste;
    this.isAfterPaste = false;
    this.doCmd = doCmd;
    this.applyParagraph = applyParagraph;
    this.applyFontName = applyFontName;
    this.applyFontSize = applyFontSize;
    this.applyBullets = applyBullets;
    this.applyNumbering = applyNumbering;
    this.applyJustifyLeft = applyJustifyLeft;
    this.applyJustifyCenter = applyJustifyCenter;
    this.applyJustifyRight = applyJustifyRight;
    this.applyJustifyFull = applyJustifyFull;
    this.applyBlockDirLTR = applyBlockDirLTR;
    this.applyBlockDirRTL = applyBlockDirRTL;
    this.doPaste = doPaste;
    this.doPasteText = doPasteText;
    this.applySpan = applySpan;
    this.makeAbsolute = makeAbsolute;
    this.insertHTML = insertHTML;
    this.clearAll = clearAll;
    this.insertCustomTag = insertCustomTag;
    this.selectParagraph = selectParagraph;
    this.hide = hide;
    this.width = "700";
    this.height = "350";
    this.publishingPath = "";
    var a = document.getElementsByTagName("script");
    for (var c = 0; c < a.length; c++) {
        var b = a[c].src.toLowerCase();
        if (b.indexOf("scripts/editor.js") != -1) {
            this.scriptPath = a[c].src.replace(/editor.js/, "")
        }
    }
    this.iconPath = "icons/";
    this.iconWidth = 29;
    this.iconHeight = 25;
    this.iconOffsetTop;
    this.dropTopAdjustment = -1;
    this.dropLeftAdjustment = 0;
    this.heightAdjustment = -70;
    this.runtimeBorder = runtimeBorder;
    this.runtimeBorderOn = runtimeBorderOn;
    this.runtimeBorderOff = runtimeBorderOff;
    this.IsRuntimeBorderOn = true;
    this.runtimeStyles = runtimeStyles;
    this.applyColor = applyColor;
    this.customColors = [];
    this.oColor1 = new ColorPicker("oColor1", this.oName);
    this.oColor2 = new ColorPicker("oColor2", this.oName);
    this.expandSelection = expandSelection;
    this.fullScreen = fullScreen;
    this.stateFullScreen = false;
    this.onFullScreen = function () {
        return true
    };
    this.onNormalScreen = function () {
        return true
    };
    this.arrElm = new Array(300);
    this.getElm = iwe_getElm;
    this.features = [];
    this.buttonMap = ["Save", "FullScreen", "Preview", "Print", "Search", "SpellCheck", "Cut", "Copy", "Paste", "PasteWord", "PasteText", "Undo", "Redo", "ForeColor", "BackColor", "Bookmark", "Hyperlink", "Image", "Flash", "Media", "YoutubeVideo", "ContentBlock", "InternalLink", "InternalImage", "CustomObject", "Table", "AutoTable", "Guidelines", "Absolute", "Characters", "Line", "Form", "RemoveFormat", "HTMLFullSource", "HTMLSource", "XHTMLFullSource", "XHTMLSource", "ClearAll", "BRK", "StyleAndFormatting", "Styles", "CustomTag", "Paragraph", "FontName", "FontSize", "Bold", "Italic", "Underline", "Strikethrough", "Superscript", "Subscript", "JustifyLeft", "JustifyCenter", "JustifyRight", "JustifyFull", "Numbering", "Bullets", "Indent", "Outdent", "LTR", "RTL"];
    this.btnSave = false;
    this.btnPreview = true;
    this.btnFullScreen = true;
    this.btnPrint = false;
    this.btnSearch = true;
    this.btnSpellCheck = false;
    this.btnTextFormatting = true;
    this.btnListFormatting = true;
    this.btnBoxFormatting = true;
    this.btnParagraphFormatting = true;
    this.btnCssText = true;
    this.btnCssBuilder = false;
    this.btnStyles = false;
    this.btnParagraph = true;
    this.btnFontName = true;
    this.btnFontSize = true;
    this.btnCut = true;
    this.btnCopy = true;
    this.btnPaste = true;
    this.btnPasteText = false;
    this.btnUndo = true;
    this.btnRedo = true;
    this.btnBold = true;
    this.btnItalic = true;
    this.btnUnderline = true;
    this.btnStrikethrough = false;
    this.btnSuperscript = false;
    this.btnSubscript = false;
    this.btnJustifyLeft = true;
    this.btnJustifyCenter = true;
    this.btnJustifyRight = true;
    this.btnJustifyFull = true;
    this.btnNumbering = true;
    this.btnBullets = true;
    this.btnIndent = true;
    this.btnOutdent = true;
    this.btnLTR = false;
    this.btnRTL = false;
    this.btnForeColor = true;
    this.btnBackColor = true;
    this.btnHyperlink = true;
    this.btnBookmark = true;
    this.btnCharacters = true;
    this.btnCustomTag = false;
    this.btnImage = true;
    this.btnFlash = false;
    this.btnMedia = false;
    this.btnTable = true;
    this.btnGuidelines = true;
    this.btnAbsolute = true;
    this.btnPasteWord = true;
    this.btnLine = true;
    this.btnForm = true;
    this.btnRemoveFormat = true;
    this.btnHTMLFullSource = false;
    this.btnHTMLSource = false;
    this.btnXHTMLFullSource = false;
    this.btnXHTMLSource = true;
    this.btnClearAll = false;
    this.btnYoutubeVideo = true;
    this.btnAutoTable = false;
    this.tabs = [
        ["tabHome", "Home", ["grpEdit", "grpFont", "grpPara"]],
        ["tabStyle", "Insert", ["grpInsert", "grpTables", "grpMedia"]]
    ];
    this.groups = [
        ["grpEdit", "", ["XHTMLSource", "FullScreen", "Search", "RemoveFormat", "BRK", "Undo", "Redo", "Cut", "Copy", "Paste", "PasteWord", "PasteText"]],
        ["grpFont", "", ["FontName", "FontSize", "Strikethrough", "Superscript", "BRK", "Bold", "Italic", "Underline", "ForeColor", "BackColor"]],
        ["grpPara", "", ["Paragraph", "Indent", "Outdent", "Styles", "StyleAndFormatting", "BRK", "JustifyLeft", "JustifyCenter", "JustifyRight", "JustifyFull", "Numbering", "Bullets"]],
        ["grpInsert", "", ["Hyperlink", "Bookmark", "BRK", "Image"]],
        ["grpTables", "", ["Table", "BRK", "Guidelines"]],
        ["grpMedia", "", ["Media", "Flash", "YoutubeVideo", "BRK", "Characters", "Line"]]
    ];
    this.toolbarMode = 1;
    this.showResizeBar = true;
    this.pasteTextOnCtrlV = false;
    this.cmdAssetManager = "";
    this.cmdFileManager = "";
    this.cmdImageManager = "";
    this.cmdMediaManager = "";
    this.cmdFlashManager = "";
    this.btnContentBlock = false;
    this.cmdContentBlock = ";";
    this.btnInternalLink = false;
    this.cmdInternalLink = ";";
    this.insertLink = insertLink;
    this.btnCustomObject = false;
    this.cmdCustomObject = ";";
    this.btnInternalImage = false;
    this.cmdInternalImage = ";";
    this.css = "";
    this.arrStyle = [];
    this.isCssLoaded = false;
    this.openStyleSelect = openStyleSelect;
    this.arrParagraph = [
        [getTxt("Heading 1"), "H1"],
        [getTxt("Heading 2"), "H2"],
        [getTxt("Heading 3"), "H3"],
        [getTxt("Heading 4"), "H4"],
        [getTxt("Heading 5"), "H5"],
        [getTxt("Heading 6"), "H6"],
        [getTxt("Preformatted"), "PRE"],
        [getTxt("Normal (P)"), "P"],
        [getTxt("Normal (DIV)"), "DIV"]
    ];
    this.arrFontName = ["Arial", "Arial Black", "Arial Narrow", "Book Antiqua", "Bookman Old Style", "Century Gothic", "Comic Sans MS", "Courier New", "Franklin Gothic Medium", "Garamond", "Georgia", "Impact", "Lucida Console", "Lucida Sans", "Lucida Unicode", "Modern", "Monotype Corsiva", "Palatino Linotype", "Roman", "Script", "Small Fonts", "Symbol", "Tahoma", "Times New Roman", "Trebuchet MS", "Verdana", "Webdings", "Wingdings", "Wingdings 2", "Wingdings 3", "serif", "sans-serif", "cursive", "fantasy", "monospace"];
    this.arrFontSize = [
        [getTxt("Size 1"), "1"],
        [getTxt("Size 2"), "2"],
        [getTxt("Size 3"), "3"],
        [getTxt("Size 4"), "4"],
        [getTxt("Size 5"), "5"],
        [getTxt("Size 6"), "6"],
        [getTxt("Size 7"), "7"]
    ];
    this.arrCustomTag = [];
    this.docType = "";
    this.html = "<html>";
    this.headContent = "";
    this.preloadHTML = "";
    this.originalContent = "";
    this.isContentChanged = isContentChanged;
    this.onSave = function () {
        document.getElementById("iwe_btnSubmit" + this.oName).click()
    };
    this.useBR = false;
    this.useDIV = true;
    this.doUndo = doUndo;
    this.doRedo = doRedo;
    this.saveForUndo = saveForUndo;
    this.arrUndoList = [];
    this.arrRedoList = [];
    this.useTagSelector = true;
    this.TagSelectorPosition = "bottom";
    this.moveTagSelector = moveTagSelector;
    this.selectElement = selectElement;
    this.removeTag = removeTag;
    this.doClick_TabCreate = doClick_TabCreate;
    this.doRefresh_TabCreate = doRefresh_TabCreate;
    this.arrCustomButtons = [
        ["CustomName1", "alert(0)", "caption here", "btnSave.gif"],
        ["CustomName2", "alert(0)", "caption here", "btnSave.gif"]
    ];
    this.onSelectionChanged = function () {
        return true
    };
    this.spellCheckMode = "ieSpell";
    this.encodeIO = false;
    this.changeHeight = changeHeight;
    this.fixWord = fixWord;
    this.rangeBookmark = null;
    this.controlBookmark = null;
    this.REPLACE = REPLACE;
    this.idTextArea;
    this.mode = "XHTMLBody";
    var d = this;
    this.tbar = new ISToolbarManager(this.oName);
    this.tbar.iconPath = this.scriptPath + this.iconPath
}function saveForUndo() {
    var a = eval("idContent" + this.oName);
    var b = eval(this.oName);
    if (b.arrUndoList[0]) {
        if (a.document.body.innerHTML == b.arrUndoList[0][0]) {
            return
        }
    }
    for (var i = 20; i > 1; i--) {
        b.arrUndoList[i - 1] = b.arrUndoList[i - 2]
    }
    b.focus();
    var c = a.document.selection.createRange();
    var d = a.document.selection.type;
    if (d == "None") {
        b.arrUndoList[0] = [a.document.body.innerHTML, a.document.selection.createRange().getBookmark(), "None"]
    } else {
        if (d == "Text") {
            b.arrUndoList[0] = [a.document.body.innerHTML, a.document.selection.createRange().getBookmark(), "Text"]
        } else {
            if (d == "Control") {
                c.item(0).selThis = "selThis";
                b.arrUndoList[0] = [a.document.body.innerHTML, null, "Control"];
                c.item(0).removeAttribute("selThis", 0)
            }
        }
    }
    this.arrRedoList = [];
    if (this.btnUndo) {
        this.tbar.btns["btnUndo" + this.oName].setState(1)
    }
    if (this.btnRedo) {
        this.tbar.btns["btnRedo" + this.oName].setState(5)
    }
}function doUndo() {
    var a = eval("idContent" + this.oName);
    var b = eval(this.oName);
    if (!b.arrUndoList[0]) {
        return
    }
    for (var i = 20; i > 1; i--) {
        b.arrRedoList[i - 1] = b.arrRedoList[i - 2]
    }
    var c = a.document.selection.createRange();
    var d = a.document.selection.type;
    if (d == "None") {
        this.arrRedoList[0] = [a.document.body.innerHTML, a.document.selection.createRange().getBookmark(), "None"]
    } else {
        if (d == "Text") {
            this.arrRedoList[0] = [a.document.body.innerHTML, a.document.selection.createRange().getBookmark(), "Text"]
        } else {
            if (d == "Control") {
                c.item(0).selThis = "selThis";
                this.arrRedoList[0] = [a.document.body.innerHTML, null, "Control"];
                c.item(0).removeAttribute("selThis", 0)
            }
        }
    }
    sHTML = b.arrUndoList[0][0];
    sHTML = fixPathEncode(sHTML);
    a.document.body.innerHTML = sHTML;
    fixPathDecode(a);
    this.runtimeBorder(false);
    this.runtimeStyles();
    var e = a.document.body.createTextRange();
    if (b.arrUndoList[0][2] == "None") {
        e.moveToBookmark(b.arrUndoList[0][1]);
        e.select()
    } else {
        if (b.arrUndoList[0][2] == "Text") {
            e.moveToBookmark(b.arrUndoList[0][1]);
            e.select()
        } else {
            if (b.arrUndoList[0][2] == "Control") {
                for (var i = 0; i < a.document.all.length; i++) {
                    if (a.document.all[i].selThis == "selThis") {
                        var f = a.document.body.createControlRange();
                        f.add(a.document.all[i]);
                        f.select();
                        a.document.all[i].removeAttribute("selThis", 0)
                    }
                }
            }
        }
    }
    for (var i = 0; i < 19; i++) {
        b.arrUndoList[i] = b.arrUndoList[i + 1]
    }
    b.arrUndoList[19] = null;
    realTime(this.oName)
}function doRedo() {
    var a = eval("idContent" + this.oName);
    var b = eval(this.oName);
    if (!b.arrRedoList[0]) {
        return
    }
    for (var i = 20; i > 1; i--) {
        b.arrUndoList[i - 1] = b.arrUndoList[i - 2]
    }
    var c = a.document.selection.createRange();
    var d = a.document.selection.type;
    if (d == "None") {
        b.arrUndoList[0] = [a.document.body.innerHTML, a.document.selection.createRange().getBookmark(), "None"]
    } else {
        if (d == "Text") {
            b.arrUndoList[0] = [a.document.body.innerHTML, a.document.selection.createRange().getBookmark(), "Text"]
        } else {
            if (d == "Control") {
                c.item(0).selThis = "selThis";
                this.arrUndoList[0] = [a.document.body.innerHTML, null, "Control"];
                c.item(0).removeAttribute("selThis", 0)
            }
        }
    }
    sHTML = b.arrRedoList[0][0];
    sHTML = fixPathEncode(sHTML);
    a.document.body.innerHTML = sHTML;
    fixPathDecode(a);
    this.runtimeBorder(false);
    this.runtimeStyles();
    var e = a.document.body.createTextRange();
    if (b.arrRedoList[0][2] == "None") {
        e.moveToBookmark(b.arrRedoList[0][1])
    } else {
        if (b.arrRedoList[0][2] == "Text") {
            e.moveToBookmark(b.arrRedoList[0][1]);
            e.select()
        } else {
            if (b.arrRedoList[0][2] == "Control") {
                for (var i = 0; i < a.document.all.length; i++) {
                    if (a.document.all[i].selThis == "selThis") {
                        var f = a.document.body.createControlRange();
                        f.add(a.document.all[i]);
                        f.select();
                        a.document.all[i].removeAttribute("selThis", 0)
                    }
                }
            }
        }
    }
    for (var i = 0; i < 19; i++) {
        b.arrRedoList[i] = b.arrRedoList[i + 1]
    }
    b.arrRedoList[19] = null;
    realTime(this.oName)
}
var bOnSubmitOriginalSaved = false;

function REPLACE(c, e) {
    this.idTextArea = c;
    var a = document.getElementById(c);
    a.style.display = "none";
    var d = a.form;
    if (d) {
        if (!bOnSubmitOriginalSaved) {
            onsubmit_original = d.onsubmit;
            bOnSubmitOriginalSaved = true
        }
        d.onsubmit = new Function("return onsubmit_new()")
    }
    var b = document.getElementById(c).value;
    b = b.replace(/&/g, "&amp;");
    b = b.replace(/</g, "&lt;");
    b = b.replace(/>/g, "&gt;");
    this.RENDER(b, e)
}function isContentChanged() {
    var a = "";
    if (this.mode == "HTMLBody") {
        a = this.getHTMLBody()
    } else {
        if (this.mode == "HTML") {
            a = this.getHTML()
        } else {
            if (this.mode == "XHTMLBody") {
                a = this.getXHTMLBody()
            } else {
                if (this.mode == "XHTML") {
                    a = this.getXHTML()
                }
            }
        }
    }
    if (a != this.originalContent) {
        return true
    }
    return false
}function onsubmit_new() {
    var a;
    for (var i = 0; i < oUtil.arrEditor.length; i++) {
        var b = eval(oUtil.arrEditor[i]);
        var c = eval("idContent" + b.oName);
        var d = c.document.getElementsByTagName("SPAN");
        for (var j = 0; j < d.length; j++) {
            if ((d[j].innerHTML == "") && (d[j].parentElement.children.length == 1)) {
                d[j].innerHTML = "&nbsp;"
            }
        }
        if (b.mode == "HTMLBody") {
            a = b.getHTMLBody()
        }
        if (b.mode == "HTML") {
            a = b.getHTML()
        }
        if (b.mode == "XHTMLBody") {
            a = b.getXHTMLBody()
        }
        if (b.mode == "XHTML") {
            a = b.getXHTML()
        }
        document.getElementById(b.idTextArea).value = a
    }
    if (onsubmit_original) {
        return onsubmit_original()
    }
}function onsubmit_original() {}
var iconHeight;

function RENDER(b, c) {
    if (document.compatMode && document.compatMode != "BackCompat") {
        if (String(this.height).indexOf("%") == -1) {
            var d = parseInt(this.height, 10);
            d += this.heightAdjustment;
            this.height = d + "px"
        }
    }
    iconHeight = this.iconHeight;
    if (b.substring(0, 4) == "<!--" && b.substring(b.length - 3) == "-->") {
        b = b.substring(4, b.length - 3)
    }
    if (b.substring(0, 4) == "<!--" && b.substring(b.length - 6) == "--&gt;") {
        b = b.substring(4, b.length - 6)
    }
    b = b.replace(/&lt;/g, "<");
    b = b.replace(/&gt;/g, ">");
    b = b.replace(/&amp;/g, "&");
    if (this.cmdContentBlock != ";") {
        this.btnContentBlock = true
    }
    if (this.cmdInternalLink != ";") {
        this.btnInternalLink = true
    }
    if (this.cmdInternalImage != ";") {
        this.btnInternalImage = true
    }
    if (this.cmdCustomObject != ";") {
        this.btnCustomObject = true
    }
    if (this.arrCustomTag.length > 0) {
        this.btnCustomTag = true
    }
    if (this.mode == "HTMLBody") {
        this.btnXHTMLSource = true;
        this.btnXHTMLFullSource = false
    }
    if (this.mode == "HTML") {
        this.btnXHTMLFullSource = true;
        this.btnXHTMLSource = false
    }
    if (this.mode == "XHTMLBody") {
        this.btnXHTMLSource = true;
        this.btnXHTMLFullSource = false
    }
    if (this.mode == "XHTML") {
        this.btnXHTMLFullSource = true;
        this.btnXHTMLSource = false
    }
    var e = false;
    if (this.features.length > 0) {
        e = true;
        for (var i = 0; i < this.buttonMap.length; i++) {
            eval(this.oName + ".btn" + this.buttonMap[i] + "=true")
        }
        this.btnTextFormatting = false;
        this.btnListFormatting = false;
        this.btnBoxFormatting = false;
        this.btnParagraphFormatting = false;
        this.btnCssText = false;
        this.btnCssBuilder = false;
        for (var j = 0; j < this.features.length; j++) {
            eval(this.oName + ".btn" + this.features[j] + "=true")
        }
        for (var i = 0; i < this.buttonMap.length; i++) {
            sButtonName = this.buttonMap[i];
            bBtnExists = false;
            for (var j = 0; j < this.features.length; j++) {
                if (sButtonName == this.features[j]) {
                    bBtnExists = true
                }
            }
            if (!bBtnExists) {
                eval(this.oName + ".btn" + sButtonName + "=false")
            }
        }
        this.buttonMap = this.features
    }
    this.preloadHTML = b;
    var f = "";
    var g = "";
    var h = "";
    this.oColor1.url = this.scriptPath + "color_picker_fg.htm";
    this.oColor1.onShow = new Function(this.oName + ".hide()");
    this.oColor1.onMoreColor = new Function(this.oName + ".hide()");
    this.oColor1.onPickColor = new Function(this.oName + ".applyColor('ForeColor',eval('" + this.oName + "').oColor1.color)");
    this.oColor1.onRemoveColor = new Function(this.oName + ".applyColor('ForeColor','')");
    this.oColor1.txtCustomColors = getTxt("Custom Colors");
    this.oColor1.txtMoreColors = getTxt("More Colors...");
    this.oColor2.url = this.scriptPath + "color_picker_bg.htm";
    this.oColor2.onShow = new Function(this.oName + ".hide()");
    this.oColor2.onMoreColor = new Function(this.oName + ".hide()");
    this.oColor2.onPickColor = new Function(this.oName + ".applyColor('BackColor',eval('" + this.oName + "').oColor2.color)");
    this.oColor2.onRemoveColor = new Function(this.oName + ".applyColor('BackColor','')");
    this.oColor2.txtCustomColors = getTxt("Custom Colors");
    this.oColor2.txtMoreColors = getTxt("More Colors...");
    var k = this;
    if (this.toolbarMode != 0) {
        var l = null,
            tmpTb, grpMap = new Object();
        for (var i = 0; i < this.buttonMap.length; i++) {
            eval(this.oName + ".btn" + this.buttonMap[i] + "=false")
        }
        for (var i = 0; i < this.groups.length; i++) {
            l = this.groups[i];
            tmpTb = this.tbar.createToolbar(this.oName + "tbar" + l[0]);
            tmpTb.onClick = function (a) {
                tbAction(tmpTb, a, k, k.oName)
            };
            tmpTb.style.toolbar = "main_istoolbar";
            tmpTb.iconPath = this.scriptPath + this.iconPath;
            tmpTb.btnWidth = this.iconWidth;
            tmpTb.btnHeight = this.iconHeight;
            for (var j = 0; j < l[2].length; j++) {
                eval(this.oName + ".btn" + l[2][j] + "=true")
            }
            buildToolbar(tmpTb, this, l[2]);
            grpMap[l[0]] = l[1]
        }
        if (this.toolbarMode == 1) {
            var m = this.tbar.createTbTab("tabCtl" + this.oName),
                n;
            for (var i = 0; i < this.tabs.length; i++) {
                l = this.tabs[i];
                n = this.tbar.createTbGroup(this.oName + "grp" + l[0]);
                for (var j = 0; j < l[2].length; j++) {
                    n.addGroup(this.oName + l[2][j], grpMap[l[2][j]], this.oName + "tbar" + l[2][j])
                }
                m.addTab(this.oName + l[0], l[1], n)
            }
        } else {
            if (this.groups.length > 0) {
                var n;
                n = this.tbar.createTbGroup(this.oName + "grp");
                for (var i = 0; i < this.groups.length; i++) {
                    l = this.groups[i];
                    n.addGroup(this.oName + l[0], grpMap[l[0]], this.oName + "tbar" + l[0])
                }
            }
        }
    } else {
        var o = this.tbar.createToolbar(this.oName);
        o.onClick = function (a) {
            tbAction(o, a, k, k.oName)
        };
        o.iconPath = this.scriptPath + this.iconPath;
        o.btnWidth = this.iconWidth;
        o.btnHeight = this.iconHeight;
        buildToolbar(o, this, this.buttonMap)
    }
    var p = "";
    p += "<iframe name=idFixZIndex" + this.oName + " id=idFixZIndex" + this.oName + "  frameBorder=0 style='display:none;position:absolute;filter:progid:DXImageTransform.Microsoft.Alpha(style=0,opacity=0)' src='" + this.scriptPath + "blank.gif' ></iframe>";
    p += "<table id=idArea" + this.oName + " name=idArea" + this.oName + " border=0 cellpadding=0 cellspacing=0 width='" + this.width + "' height='" + this.height + "' style='border-bottom:#cfcfcf 1px solid'><tr><td colspan=2 style=\"position:relative;padding:0px;padding-left:0px;border:#cfcfcf 0px solid;border-bottom:0;background:url('" + this.scriptPath + "icons/bg.gif')\"><table cellpadding=0 cellspacing=0 width='100%' id='idToolbar" + this.oName + "'><tr><td dir=ltr style='padding:0px'>" + this.tbar.render() + "</td></tr></table></td></tr><tr id=idTagSelTopRow" + this.oName + "><td colspan=2 id=idTagSelTop" + this.oName + " height=0 style='padding:0px'></td></tr>";
    p += "<tr style='width:100%;height:100%'><td colspan=2 valign=top height=100% style='padding:0px;background:white;'>";
    p += "<table cellpadding=0 cellspacing=0 width=100% height=100%><tr><td width=100% height=100% style='padding:0px;border:#cfcfcf 1px solid;border-bottom:none'>";
    if (this.IsSecurityRestricted) {
        p += "<iframe security='restricted' style='width:100%;height:100%;' frameborder='no' src='" + this.scriptPath + "blank.gif' name=idContent" + this.oName + " id=idContent" + this.oName + " contentEditable=true></iframe>"
    } else {
        p += "<iframe style='width:100%;height:100%;' frameborder='no' src='" + this.scriptPath + "blank.gif' name=idContent" + this.oName + " id=idContent" + this.oName + " contentEditable=true></iframe>"
    }
    p += "<iframe style='position:absolute;left:-1000px;top:-1000px;width:1px;height:1px;overflow:auto;' src='" + this.scriptPath + "blank.gif' name=idContentWord" + this.oName + " id=idContentWord" + this.oName + " contentEditable=true onfocus='" + this.oName + ".hide()'></iframe>";
    p += "</td><td id=idStyles" + this.oName + " style='padding:0px;background:#f4f4f4' valign=top></td></tr></table>";
    p += "</td></tr>";
    p += "<tr id=idTagSelBottomRow" + this.oName + "><td colspan=2 id=idTagSelBottom" + this.oName + " style='padding:0px;'></td></tr>";
    if (this.showResizeBar) {
        p += "<tr id=idResizeBar" + this.oName + "><td colspan=2 style='padding:0px;'><div class='resize_bar' style='cursor:n-resize;' onmousedown=\"onEditorStartResize(event, this, '" + this.oName + "')\" ></div></td></tr>"
    }
    p += "</table>";
    p += f;
    p += "<input type=submit name=iwe_btnSubmit" + this.oName + " id=iwe_btnSubmit" + this.oName + " value=SUBMIT style='display:none' >";
    if (c) {
        var q = [];
        q[0] = p;
        document.getElementById(c).innerHTML = q.join("")
    } else {
        document.write(p)
    }
    this.init()
}function onEditorStartResize(a, b, c) {
    document.onmousemove = onEditorResize;
    document.onmouseup = onEditorStopResize;
    document.onselectstart = function () {
        return false
    };
    document.ondragstart = function () {
        return false
    };
    document.body.style.cursor = "n-resize";
    oUtil.currentResized = eval(c);
    oUtil.resizeInit = {
        x: a.screenX,
        y: a.screenY
    };
    if (!oUtil.isWindow) {
        oUtil.isWindow = new ISWindow(c)
    }
    oUtil.isWindow.showOverlay()
}function onEditorStopResize() {
    oUtil.resizeOffset = {
        dx: event.screenX - oUtil.resizeInit.x,
        dy: event.screenY - oUtil.resizeInit.y
    };
    oUtil.currentResized.changeHeight(oUtil.resizeOffset.dy);
    oUtil.isWindow.hideOverlay();
    document.onmousemove = null;
    document.onmouseup = null;
    document.body.style.cursor = "default"
}function onEditorResize() {
    oUtil.resizeOffset = {
        dx: event.screenX - oUtil.resizeInit.x,
        dy: event.screenY - oUtil.resizeInit.y
    };
    oUtil.currentResized.changeHeight(oUtil.resizeOffset.dy);
    oUtil.resizeInit = {
        x: event.screenX,
        y: event.screenY
    }
}function initISEditor() {
    if (this.useTagSelector) {
        if (this.TagSelectorPosition == "bottom") {
            this.TagSelectorPosition = "top"
        } else {
            this.TagSelectorPosition = "bottom"
        }
        this.moveTagSelector()
    }
    oUtil.oName = this.oName;
    oUtil.oEditor = eval("idContent" + this.oName);
    if (!isIE9) {
        oUtil.oEditor.document.designMode = "on"
    }
    oUtil.obj = eval(this.oName);
    oUtil.arrEditor.push(this.oName);
    eval("idArea" + this.oName).style.position = "absolute";
    window.setTimeout("eval('idArea" + this.oName + "').style.position='';", 1);
    var a = String(this.preloadHTML).match(/<HTML[^>]*>/ig);
    if (a) {
        this.loadHTML("");
        window.setTimeout(this.oName + ".putHTML(" + this.oName + ".preloadHTML)", 0)
    } else {
        this.loadHTML(this.preloadHTML)
    }
    switch (this.mode) {
        case "HTMLBody":
            this.originalContent = this.getHTMLBody();
            break;
        case "HTML":
            this.originalContent = this.getHTML();
            break;
        case "XHTMLBody":
            this.originalContent = this.getXHTMLBody();
            break;
        case "XHTML":
            this.originalContent = this.getXHTML();
            break
    }
    this.focus()
}function buildToolbar(k, g, b) {
    var v = g.oName;
    for (var y = 0; y < b.length; y++) {
        sButtonName = b[y];
        switch (sButtonName) {
            case "|":
                k.addSeparator();
                break;
            case "BRK":
                k.addBreak();
                break;
            case "Save":
                if (g.btnSave) {
                    k.addButton("btnSave" + v, "btnSave.gif", getTxt("Save"))
                }
                break;
            case "Preview":
                if (g.btnPreview) {
                    k.addDropdownButton("btnPreview" + v, "ddPreview" + v, "btnPreview.gif", getTxt("Preview"));
                    var r = new ISDropdown("ddPreview" + v);
                    r.addItem("btnPreview1" + v, "640x480");
                    r.addItem("btnPreview2" + v, "800x600");
                    r.addItem("btnPreview3" + v, "1024x768");
                    r.onClick = function (m) {
                        ddAction(k, m, g, g.oName)
                    }
                }
                break;
            case "FullScreen":
                if (g.btnFullScreen) {
                    k.addButton("btnFullScreen" + v, "btnFullScreen.gif", getTxt("Full Screen"))
                }
                break;
            case "Print":
                if (g.btnPrint) {
                    k.addButton("btnPrint" + v, "btnPrint.gif", getTxt("Print"))
                }
                break;
            case "Search":
                if (g.btnSearch) {
                    k.addButton("btnSearch" + v, "btnSearch.gif", getTxt("Search"))
                }
                break;
            case "SpellCheck":
                if (g.btnSpellCheck) {
                    k.addButton("btnSpellCheck" + v, "btnSpellCheck.gif", getTxt("Check Spelling"))
                }
                break;
            case "StyleAndFormatting":
                if (g.btnTextFormatting || g.btnParagraphFormatting || g.btnListFormatting || g.btnBoxFormatting || g.btnCssText || g.btnCssBuilder) {
                    k.addDropdownButton("btnStyleAndFormat" + v, "ddFormatting" + v, "btnStyle.gif", getTxt("Styles & Formatting"));
                    var z = new ISDropdown("ddFormatting" + v);
                    z.iconPath = k.iconPath;
                    z.onClick = function (m) {
                        ddAction(k, m, g, g.oName)
                    };
                    if (g.btnTextFormatting) {
                        z.addItem("btnTextFormatting" + v, getTxt("Text Formatting"), "btnTextFormatting.gif")
                    }
                    if (g.btnParagraphFormatting) {
                        z.addItem("btnParagraphFormatting" + v, getTxt("Paragraph Formatting"), "btnParagraphFormatting.gif")
                    }
                    if (g.btnListFormatting) {
                        z.addItem("btnListFormatting" + v, getTxt("List Formatting"), "btnListFormatting.gif")
                    }
                    if (g.btnBoxFormatting) {
                        z.addItem("btnBoxFormatting" + v, getTxt("Box Formatting"), "btnBoxFormatting.gif")
                    }
                    if (g.btnCssText) {
                        z.addItem("btnCssText" + v, getTxt("Custom CSS"), "btnCustomCss.gif")
                    }
                    if (g.btnCssBuilder) {
                        z.addItem("btnCssBuilder" + v, getTxt("CSS Builder"))
                    }
                }
                break;
            case "Styles":
                if (g.btnStyles) {
                    k.addButton("btnStyles" + v, "btnStyleSelect.gif", getTxt("Style Selection"))
                }
                break;
            case "Paragraph":
                if (g.btnParagraph) {
                    k.addDropdownButton("btnParagraph" + v, "ddParagraph" + v, "btnParagraph.gif", getTxt("Paragraph"), 37);
                    var l = new ISDropdown("ddParagraph" + v);
                    l.onClick = function (m) {
                        ddAction(k, m, g, g.oName)
                    };
                    for (var x = 0; x < g.arrParagraph.length; x++) {
                        l.addItem("btnParagraph_" + x + v, "<" + g.arrParagraph[x][1] + ' style="margin-bottom:4px"  unselectable=on> ' + g.arrParagraph[x][0] + "</" + g.arrParagraph[x][1] + ">")
                    }
                }
                break;
            case "FontName":
                if (g.btnFontName) {
                    k.addDropdownButton("btnFontName" + v, "ddFontName" + v, "btnFontName.gif", getTxt("Font Name"), 37);
                    var w = new ISDropdown("ddFontName" + v);
                    w.onClick = function (m) {
                        ddAction(k, m, g, g.oName)
                    };
                    for (var x = 0; x < g.arrFontName.length; x++) {
                        w.addItem("btnFontName_" + x + v, "<span style='font-family:" + g.arrFontName[x] + "' unselectable=on>" + g.arrFontName[x] + "</span><span unselectable=on style='font-family:tahoma'>(" + g.arrFontName[x] + ")</span>")
                    }
                }
                break;
            case "FontSize":
                if (g.btnFontSize) {
                    k.addDropdownButton("btnFontSize" + v, "ddFontSize" + v, "btnFontSize.gif", getTxt("Font Size"), 37);
                    var q = new ISDropdown("ddFontSize" + v);
                    q.onClick = function (m) {
                        ddAction(k, m, g, g.oName)
                    };
                    for (var x = 0; x < g.arrFontSize.length; x++) {
                        q.addItem("btnFontSize_" + x + v, '<font unselectable=on size="' + g.arrFontSize[x][1] + '">' + g.arrFontSize[x][0] + "</font>")
                    }
                }
                break;
            case "Cut":
                if (g.btnCut) {
                    k.addButton("btnCut" + v, "btnCut.gif", getTxt("Cut"))
                }
                break;
            case "Copy":
                if (g.btnCopy) {
                    k.addButton("btnCopy" + v, "btnCopy.gif", getTxt("Copy"))
                }
                break;
            case "Paste":
                if (g.btnPaste || g.btnPasteWord || g.btnPasteText) {
                    k.addDropdownButton("btnPaste" + v, "ddPaste" + v, "btnPaste.gif", getTxt("Paste"));
                    var r = new ISDropdown("ddPaste" + v);
                    r.iconPath = k.iconPath;
                    if (g.btnPaste) {
                        r.addItem("btnPasteClip" + v, getTxt("Paste"), "btnPasteClip.gif")
                    }
                    if (g.btnPasteWord) {
                        r.addItem("btnPasteWord" + v, getTxt("Paste from Word"), "btnPasteWord.gif")
                    }
                    if (g.btnPasteText) {
                        r.addItem("btnPasteText" + v, getTxt("Paste Text"), "btnPasteText.gif")
                    }
                    r.onClick = function (m) {
                        ddAction(k, m, g, g.oName)
                    }
                }
                break;
            case "Undo":
                if (g.btnUndo) {
                    k.addButton("btnUndo" + v, "btnUndo.gif", getTxt("Undo"))
                }
                break;
            case "Redo":
                if (g.btnRedo) {
                    k.addButton("btnRedo" + v, "btnRedo.gif", getTxt("Redo"))
                }
                break;
            case "Bold":
                if (g.btnBold) {
                    k.addToggleButton("btnBold" + v, "", false, "btnBold.gif", getTxt("Bold"))
                }
                break;
            case "Italic":
                if (g.btnItalic) {
                    k.addToggleButton("btnItalic" + v, "", false, "btnItalic.gif", getTxt("Italic"))
                }
                break;
            case "Underline":
                if (g.btnUnderline) {
                    k.addToggleButton("btnUnderline" + v, "", false, "btnUnderline.gif", getTxt("Underline"))
                }
                break;
            case "Strikethrough":
                if (g.btnStrikethrough) {
                    k.addToggleButton("btnStrikethrough" + v, "", false, "btnStrikethrough.gif", getTxt("Strikethrough"))
                }
                break;
            case "Superscript":
                if (g.btnSuperscript) {
                    k.addToggleButton("btnSuperscript" + v, "", false, "btnSuperscript.gif", getTxt("Superscript"))
                }
                break;
            case "Subscript":
                if (g.btnSubscript) {
                    k.addToggleButton("btnSubscript" + v, "", false, "btnSubscript.gif", getTxt("Subscript"))
                }
                break;
            case "JustifyLeft":
                if (g.btnJustifyLeft) {
                    k.addToggleButton("btnJustifyLeft" + v, "align", false, "btnLeft.gif", getTxt("Justify Left"))
                }
                break;
            case "JustifyCenter":
                if (g.btnJustifyCenter) {
                    k.addToggleButton("btnJustifyCenter" + v, "align", false, "btnCenter.gif", getTxt("Justify Center"))
                }
                break;
            case "JustifyRight":
                if (g.btnJustifyRight) {
                    k.addToggleButton("btnJustifyRight" + v, "align", false, "btnRight.gif", getTxt("Justify Right"))
                }
                break;
            case "JustifyFull":
                if (g.btnJustifyFull) {
                    k.addToggleButton("btnJustifyFull" + v, "align", false, "btnFull.gif", getTxt("Justify Full"))
                }
                break;
            case "Numbering":
                if (g.btnNumbering) {
                    k.addToggleButton("btnNumbering" + v, "bullet", false, "btnNumber.gif", getTxt("Numbering"))
                }
                break;
            case "Bullets":
                if (g.btnBullets) {
                    k.addToggleButton("btnBullets" + v, "bullet", false, "btnList.gif", getTxt("Bullets"))
                }
                break;
            case "Indent":
                if (g.btnIndent) {
                    k.addButton("btnIndent" + v, "btnIndent.gif", getTxt("Indent"))
                }
                break;
            case "Outdent":
                if (g.btnOutdent) {
                    k.addButton("btnOutdent" + v, "btnOutdent.gif", getTxt("Outdent"))
                }
                break;
            case "LTR":
                if (g.btnLTR) {
                    k.addToggleButton("btnLTR" + v, "dir", false, "btnLTR.gif", getTxt("Left To Right"))
                }
                break;
            case "RTL":
                if (g.btnRTL) {
                    k.addToggleButton("btnRTL" + v, "dir", false, "btnRTL.gif", getTxt("Right To Left"))
                }
                break;
            case "ForeColor":
                k.addDropdownButton("btnForeColor" + v, "ddForeColor" + v, "btnForeColor.gif", getTxt("Foreground Color"));
                var h = new ISDropdown("ddForeColor" + v);
                h.add(new ISCustomDDItem("btnInsertForeColor", g.oColor1.generateHTML()));
                break;
            case "BackColor":
                k.addDropdownButton("btnBackColor" + v, "ddBackColor" + v, "btnBackColor.gif", getTxt("Background Color"));
                var h = new ISDropdown("ddBackColor" + v);
                h.add(new ISCustomDDItem("btnInsertBackColor", g.oColor2.generateHTML()));
                break;
            case "Bookmark":
                if (g.btnBookmark) {
                    k.addButton("btnBookmark" + v, "btnBookmark.gif", getTxt("Bookmark"))
                }
                break;
            case "Hyperlink":
                if (g.btnHyperlink) {
                    k.addButton("btnHyperlink" + v, "btnHyperlink.gif", getTxt("Hyperlink"))
                }
                break;
            case "CustomTag":
                if (g.btnCustomTag) {
                    k.addDropdownButton("btnCustomTag" + v, "ddCustomTag" + v, "btnCustomTag.gif", getTxt("Tags"), 37);
                    var c = new ISDropdown("ddCustomTag" + v);
                    c.onClick = function (m) {
                        ddAction(k, m, g, g.oName)
                    };
                    for (var x = 0; x < g.arrCustomTag.length; x++) {
                        c.addItem("btnCustomTag_" + x + v, g.arrCustomTag[x][0])
                    }
                }
                break;
            case "Image":
                if (g.btnImage) {
                    k.addButton("btnImage" + v, "btnImage.gif", getTxt("Image"))
                }
                break;
            case "Flash":
                if (g.btnFlash) {
                    k.addButton("btnFlash" + v, "btnFlash.gif", getTxt("Flash"))
                }
                break;
            case "Media":
                if (g.btnMedia) {
                    k.addButton("btnMedia" + v, "btnMedia.gif", getTxt("Media"))
                }
                break;
            case "YoutubeVideo":
                if (g.btnYoutubeVideo) {
                    k.addButton("btnYoutubeVideo" + v, "btnYoutubeVideo.gif", getTxt("YoutubeVideo"))
                }
                break;
            case "ContentBlock":
                if (g.btnContentBlock) {
                    k.addButton("btnContentBlock" + v, "btnContentBlock.gif", getTxt("Content Block"))
                }
                break;
            case "InternalLink":
                if (g.btnInternalLink) {
                    k.addButton("btnInternalLink" + v, "btnInternalLink.gif", getTxt("Internal Link"))
                }
                break;
            case "InternalImage":
                if (g.btnInternalImage) {
                    k.addButton("btnInternalImage" + v, "btnInternalImage.gif", getTxt("Internal Image"))
                }
                break;
            case "CustomObject":
                if (g.btnCustomObject) {
                    k.addButton("btnCustomObject" + v, "btnCustomObject.gif", getTxt("Object"))
                }
                break;
            case "Table":
                if (g.btnTable) {
                    var o = [],
                        e = 0;
                    o[e++] = "<table width=195 id=dropTableCreate" + v + " onmouseout='doOut_TabCreate();event.cancelBubble=true' style='cursor:default;background:#f3f3f8;border:#8a867a 0px solid;' cellpadding=0 cellspacing=2 border=0 unselectable=on>";
                    for (var u = 0; u < 8; u++) {
                        o[e++] = "<tr>";
                        for (var t = 0; t < 8; t++) {
                            o[e++] = "<td onclick='" + v + ".doClick_TabCreate()' onmouseover='doOver_TabCreate()' style='background:#ffffff;font-size:1px;border:#8a867a 1px solid;width:20px;height:20px;' unselectable=on>&nbsp;</td>"
                        }
                        o[e++] = "</tr>"
                    }
                    o[e++] = '<tr><td colspan=8 onclick="' + v + ".hide();modelessDialogShow('" + g.scriptPath + "table_insert.htm',380,385);\" onmouseover=\"this.innerText='" + getTxt("Advanced Table Insert") + "';this.style.border='#777777 1px solid';this.style.backgroundColor='#444444';this.style.color='#ffffff'\" onmouseout=\"this.style.border='#f3f3f8 1px solid';this.style.backgroundColor='#f3f3f8';this.style.color='#000000'\" align=center style='font-family:verdana;font-size:10px;font-color:black;border:#f3f3f8 1px solid;' unselectable=on>" + getTxt("Advanced Table Insert") + "</td></tr>";
                    o[e++] = "</table>";
                    k.addDropdownButton("btnTable" + v, "ddTable" + v, "btnTable.gif", getTxt("Insert Table"));
                    var h = new ISDropdown("ddTable" + v);
                    h.add(new ISCustomDDItem("btnInsertTable", o.join("")));
                    k.addDropdownButton("btnTableEdit" + v, "ddTableEdit" + v, "btnTableEdit.gif", getTxt("Edit Table/Cell"));
                    var a = new ISDropdown("ddTableEdit" + v);
                    a.iconPath = k.iconPath;
                    a.onClick = function (m) {
                        ddAction(k, m, g, g.oName)
                    };
                    a.addItem("mnuTableSize" + v, getTxt("Table Size"), "btnTableSize.gif");
                    a.addItem("mnuTableEdit" + v, getTxt("Edit Table"), "btnEditTable.gif");
                    a.addItem("mnuCellEdit" + v, getTxt("Edit Cell"), "btnEditCell.gif")
                }
                break;
            case "Guidelines":
                if (g.btnGuidelines) {
                    k.addButton("btnGuidelines" + v, "btnGuideline.gif", getTxt("Show/Hide Guidelines"))
                }
                break;
            case "AutoTable":
                if (g.btnAutoTable) {
                    k.addButton("btnAutoTable" + v, "btnAutoTable.gif", getTxt("AutoTable"))
                }
                break;
            case "Absolute":
                if (g.btnAbsolute) {
                    k.addButton("btnAbsolute" + v, "btnAbsolute.gif", getTxt("Absolute"))
                }
                break;
            case "Characters":
                if (g.btnCharacters) {
                    k.addButton("btnCharacters" + v, "btnSymbol.gif", getTxt("Special Characters"))
                }
                break;
            case "Line":
                if (g.btnLine) {
                    k.addButton("btnLine" + v, "btnLine.gif", getTxt("Line"))
                }
                break;
            case "Form":
                if (g.btnForm) {
                    var p = [
                        [getTxt("Form"), "form_form.htm", "280", "177"],
                        [getTxt("Text Field"), "form_text.htm", "285", "289"],
                        [getTxt("List"), "form_list.htm", "295", "332"],
                        [getTxt("Checkbox"), "form_check.htm", "235", "174"],
                        [getTxt("Radio Button"), "form_radio.htm", "235", "177"],
                        [getTxt("Hidden Field"), "form_hidden.htm", "235", "152"],
                        [getTxt("File Field"), "form_file.htm", "235", "132"],
                        [getTxt("Button"), "form_button.htm", "235", "174"]
                    ];
                    k.addDropdownButton("btnForm" + v, "ddForm" + v, "btnForm.gif", getTxt("Form Editor"));
                    var d = new ISDropdown("ddForm" + v);
                    d.onClick = function (m) {
                        ddAction(k, m, g, g.oName)
                    };
                    for (var x = 0; x < p.length; x++) {
                        d.addItem("btnForm" + x + v, p[x][0])
                    }
                }
                break;
            case "RemoveFormat":
                if (g.btnRemoveFormat) {
                    k.addButton("btnRemoveFormat" + v, "btnRemoveFormat.gif", getTxt("Remove Formatting"))
                }
                break;
            case "HTMLFullSource":
                if (g.btnHTMLFullSource) {
                    k.addButton("btnHTMLFullSource" + v, "btnSource.gif", getTxt("View/Edit Source"))
                }
                break;
            case "HTMLSource":
                if (g.btnHTMLSource) {
                    k.addButton("btnHTMLSource" + v, "btnSource.gif", getTxt("View/Edit Source"))
                }
                break;
            case "XHTMLFullSource":
                if (g.btnXHTMLFullSource) {
                    k.addButton("btnXHTMLFullSource" + v, "btnSource.gif", getTxt("View/Edit Source"))
                }
                break;
            case "XHTMLSource":
                if (g.btnXHTMLSource) {
                    k.addButton("btnXHTMLSource" + v, "btnSource.gif", getTxt("View/Edit Source"))
                }
                break;
            case "ClearAll":
                if (g.btnClearAll) {
                    k.addButton("btnClearAll" + v, "btnDelete.gif", getTxt("Clear All"))
                }
                break;
            default:
                for (x = 0; x < g.arrCustomButtons.length; x++) {
                    if (sButtonName == g.arrCustomButtons[x][0]) {
                        sCbName = g.arrCustomButtons[x][0];
                        sCbCaption = g.arrCustomButtons[x][2];
                        sCbImage = g.arrCustomButtons[x][3];
                        if (g.arrCustomButtons[x][4]) {
                            k.addButton(sCbName + v, sCbImage, sCbCaption, g.arrCustomButtons[x][4])
                        } else {
                            k.addButton(sCbName + v, sCbImage, sCbCaption)
                        }
                    }
                }
                break
        }
    }
}function iwe_getElm(a) {
    return document.getElementById(a + this.oName)
}
var arrColorPickerObjects = [];

function ColorPicker(a, b) {
    this.oParent = b;
    if (b) {
        this.oName = b + "." + a;
        this.oRenderName = a + b
    } else {
        this.oName = a;
        this.oRenderName = a
    }
    arrColorPickerObjects.push(this.oName);
    this.url = "color_picker.htm";
    this.onShow = function () {
        return true
    };
    this.onHide = function () {
        return true
    };
    this.onPickColor = function () {
        return true
    };
    this.onRemoveColor = function () {
        return true
    };
    this.onMoreColor = function () {
        return true
    };
    this.show = showColorPicker;
    this.hide = hideColorPicker;
    this.hideAll = hideColorPickerAll;
    this.color;
    this.customColors = [];
    this.refreshCustomColor = refreshCustomColor;
    this.isActive = false;
    this.txtCustomColors = "Custom Colors";
    this.txtMoreColors = "More Colors...";
    this.align = "left";
    this.currColor = "#ffffff";
    this.generateHTML = generateHTML;
    this.RENDER = drawColorPicker
}function generateHTML() {
    var a = [
        ["#800000", "#8b4513", "#006400", "#2f4f4f", "#000080", "#4b0082", "#800080", "#000000"],
        ["#ff0000", "#daa520", "#6b8e23", "#708090", "#0000cd", "#483d8b", "#c71585", "#696969"],
        ["#ff4500", "#ffa500", "#808000", "#4682b4", "#1e90ff", "#9400d3", "#ff1493", "#a9a9a9"],
        ["#ff6347", "#ffd700", "#32cd32", "#87ceeb", "#00bfff", "#9370db", "#ff69b4", "#dcdcdc"],
        ["#ffdab9", "#ffffe0", "#98fb98", "#e0ffff", "#87cefa", "#e6e6fa", "#dda0dd", "#ffffff"]
    ];
    var d = "<table id=dropColor" + this.oRenderName + " style=\"z-index:2000;cursor:default;background-color:#f4f4f4;padding:2px\" unselectable=on cellpadding=0 cellspacing=0 width=143 height=109><tr><td unselectable=on style='padding:0px;'>";
    d += "<table align=center cellpadding=0 cellspacing=0 border=0 unselectable=on>";
    for (var c = 0; c < a.length; c++) {
        d += "<tr>";
        for (var b = 0; b < a[c].length; b++) {
            d += '<td onclick="' + this.oName + ".color='" + a[c][b] + "';" + this.oName + ".onPickColor();" + this.oName + ".currColor='" + a[c][b] + "';" + this.oName + '.hideAll()" onmouseover="this.style.border=\'#777777 1px solid\'" onmouseout="this.style.border=\'#f4f4f4 1px solid\'" style="cursor:default;padding:1px;border:#f4f4f4 1px solid;" unselectable=on><table style=\'margin:0px;width:13px;height:13px;background:' + a[c][b] + ";border:white 1px solid' cellpadding=0 cellspacing=0 unselectable=on><tr><td unselectable=on></td></tr></table></td>"
        }
        d += "</tr>"
    }
    d += "<tr><td colspan=8 id=idCustomColor" + this.oRenderName + " style='padding:0px;'></td></tr>";
    d += "<tr>";
    d += "<td unselectable=on style='padding:0px;'><table style='margin-left:1px;width:14px;height:14px;background:#f4f4f4;' cellpadding=0 cellspacing=0 unselectable=on><tr><td onclick=\"" + this.oName + ".onRemoveColor();" + this.oName + ".currColor='';" + this.oName + '.hideAll()" onmouseover="this.style.border=\'#777777 1px solid\'" onmouseout="this.style.border=\'white 1px solid\'" style="cursor:default;padding:1px;border:white 1px solid;font-family:verdana;font-size:10px;font-color:black;line-height:9px;" align=center valign=top unselectable=on>x</td></tr></table></td>';
    d += "<td colspan=7 unselectable=on style='padding:0px;'><table style='margin:1px;width:117px;height:16px;background:#f4f4f4;border:white 1px solid' cellpadding=0 cellspacing=0 unselectable=on><tr><td onclick=\"" + this.oName + ".onMoreColor();" + this.oName + ".hideAll();modelessDialogShow('" + this.url + "',448,440, window,{'oName':'" + this.oName + "'});\" onmouseover=\"this.style.border='#777777 1px solid';this.style.background='#444444';this.style.color='#ffffff'\" onmouseout=\"this.style.border='#f4f4f4 1px solid';this.style.background='#f4f4f4';this.style.color='#000000'\" style=\"cursor:default;padding:1px;border:#efefef 1px solid\" style=\"font-family:verdana;font-size:9px;font-color:black;line-height:9px;padding:1px\" align=center valign=top nowrap unselectable=on>" + this.txtMoreColors + "</td></tr></table></td>";
    d += "</tr>";
    d += "</table>";
    d += "</td></tr></table>";
    return d
}function drawColorPicker() {
    document.write(this.generateHTML())
}function refreshCustomColor() {
    this.customColors = eval(this.oParent).customColors;
    if (this.customColors.length == 0) {
        eval("idCustomColor" + this.oRenderName).innerHTML = "";
        return
    }
    sHTML = '<table cellpadding=0 cellspacing=0 width=100%><tr><td colspan=8 style="font-family:verdana;font-size:9px;font-color:black;line-height:9px;padding:1">' + this.txtCustomColors + ":</td></tr></table>";
    sHTML += "<table cellpadding=0 cellspacing=0><tr>";
    for (var i = 0; i < this.customColors.length; i++) {
        if (i < 22) {
            if (i == 8 || i == 16 || i == 24 || i == 32) {
                sHTML += "</tr></table><table cellpadding=0 cellspacing=0><tr>"
            }
            sHTML += '<td onclick="' + this.oName + ".color='" + this.customColors[i] + "';" + this.oName + '.onPickColor()" onmouseover="this.style.border=\'#777777 1px solid\'" onmouseout="this.style.border=\'#f4f4f4 1px solid\'" style="cursor:default;padding:1px;border:#f4f4f4 1px solid;" unselectable=on> <table  style=\'margin:0;width:13px;height:13px;background:' + this.customColors[i] + ";border:white 1px solid' cellpadding=0 cellspacing=0 unselectable=on> <tr><td unselectable=on></td></tr> </table></td>"
        }
    }
    sHTML += "</tr></table>";
    eval("idCustomColor" + this.oRenderName).innerHTML = sHTML
}function showColorPicker(a) {
    this.refreshCustomColor()
}function hideColorPicker() {
    this.onHide();
    return;
    var a = eval("dropColor" + this.oRenderName);
    a.style.display = "none";
    this.isActive = false
}function hideColorPickerAll() {
    return;
    for (var i = 0; i < arrColorPickerObjects.length; i++) {
        var a = eval("dropColor" + eval(arrColorPickerObjects[i]).oRenderName);
        a.style.display = "none";
        eval(arrColorPickerObjects[i]).isActive = false
    }
}function loadHTML(a) {
    var b = eval("idContent" + this.oName);
    var c = "";
    if (this.css != "") {
        c = "<link href='" + this.css + "' rel='stylesheet' type='text/css'>"
    }
    var d = b.document.open("text/html", "replace");
    if (this.publishingPath != "") {
        var e = String(this.preloadHTML).match(/<base[^>]*>/ig);
        if (!e) {
            a = this.docType + '<html><head><base href="' + this.publishingPath + '"/>' + this.headContent + c + "</head><body contenteditable=true>" + a + "</body></html>"
        }
    } else {
        a = this.docType + "<html><head>" + this.headContent + c + "</head><body contentEditable='true'>" + a + "</body></html>"
    }
    d.write(a);
    d.close();
    b.document.body.contentEditable = true;
    b.document.execCommand("2D-Position", true, true);
    b.document.execCommand("MultipleSelection", true, true);
    b.document.execCommand("LiveResize", true, true);
    b.document.body.onkeyup = new Function("editorDoc_onkeyup('" + this.oName + "')");
    b.document.body.onmouseup = new Function("editorDoc_onmouseup('" + this.oName + "')");
    b.document.body.onkeydown = new Function("doKeyPress(eval('idContent" + this.oName + "').event,'" + this.oName + "')");
    this.runtimeBorder(false);
    this.runtimeStyles();
    b.document.body.onpaste = new Function("return " + this.oName + ".doOnPaste()");
    b.document.body.oncut = new Function(this.oName + ".saveForUndo()");
    b.document.body.style.lineHeight = "1.2";
    b.document.body.style.lineHeight = "";
    if (this.initialRefresh) {
        b.document.execCommand("SelectAll");
        window.setTimeout("eval('idContentWord" + this.oName + "').document.execCommand('SelectAll');", 0)
    }
    if (isIE9) {
        if (this.arrStyle.length > 0) {
            var f = b.document.createElement("STYLE");
            b.document.documentElement.childNodes[0].appendChild(f);
            var g = "";
            for (var i = 0; i < this.arrStyle.length; i++) {
                selector = this.arrStyle[i][0];
                style = this.arrStyle[i][3];
                g += selector + " { " + style + " } "
            }
            f.appendChild(b.document.createTextNode(g))
        }
    } else {
        if (this.arrStyle.length > 0) {
            var f = b.document.createElement("STYLE");
            var n = b.document.styleSheets.length;
            b.document.documentElement.childNodes[0].appendChild(f);
            for (var i = 0; i < this.arrStyle.length; i++) {
                selector = this.arrStyle[i][0];
                style = this.arrStyle[i][3];
                b.document.styleSheets[n].addRule(selector, style)
            }
        }
    }
    this.cleanDeprecated()
}function putHTML(a) {
    var b = eval("idContent" + this.oName);
    var c = String(a).match(/<!DOCTYPE[^>]*>/ig);
    if (c) {
        for (var i = 0; i < c.length; i++) {
            this.docType = c[i]
        }
    } else {
        this.docType = ""
    }
    var d = String(a).match(/<HTML[^>]*>/ig);
    if (d) {
        for (var i = 0; i < d.length; i++) {
            s = d[i];
            s = s.replace(/\"[^\"]*\"/ig, function (x) {
                x = x.replace(/&/g, "&amp;").replace(/</g, "&lt;").replace(/>/g, "&gt;").replace(/'/g, "&apos;").replace(/\s+/ig, "#_#");
                return x
            });
            s = s.replace(/<([^ >]*)/ig, function (x) {
                return x.toLowerCase()
            });
            s = s.replace(/ ([^=]+)=([^" >]+)/ig, ' $1="$2"');
            s = s.replace(/ ([^=]+)=/ig, function (x) {
                return x.toLowerCase()
            });
            s = s.replace(/#_#/ig, " ");
            this.html = s
        }
    } else {
        this.html = "<html>"
    }
    if (this.publishingPath != "") {
        var c = a.match(/<base[^>]*>/ig);
        if (!c) {
            a = '<BASE HREF="' + this.publishingPath + '"/>' + a
        }
    }
    var e = b.document.open("text/html", "replace");
    e.write(a);
    e.close();
    b.document.body.contentEditable = true;
    b.document.execCommand("2D-Position", true, true);
    b.document.execCommand("MultipleSelection", true, true);
    b.document.execCommand("LiveResize", true, true);
    b.document.body.onkeyup = new Function("editorDoc_onkeyup('" + this.oName + "')");
    b.document.body.onmouseup = new Function("editorDoc_onmouseup('" + this.oName + "')");
    b.document.body.onkeydown = new Function("doKeyPress(eval('idContent" + this.oName + "').event,'" + this.oName + "')");
    this.runtimeBorder(false);
    this.runtimeStyles();
    this.cleanDeprecated()
}function encodeHTMLCode(a) {
    return a.replace(/&/g, "&amp;").replace(/</g, "&lt;").replace(/>/g, "&gt;")
}function getTextBody() {
    var a = eval("idContent" + this.oName);
    return a.document.body.innerText
}function getHTML() {
    var a = eval("idContent" + this.oName);
    this.cleanDeprecated();
    sHTML = a.document.documentElement.outerHTML;
    sHTML = String(sHTML).replace(/ contentEditable=true/g, "");
    sHTML = String(sHTML).replace(/\<PARAM NAME=\"Play\" VALUE=\"0\">/ig, '<PARAM NAME="Play" VALUE="-1">');
    sHTML = this.docType + sHTML;
    sHTML = oUtil.replaceSpecialChar(sHTML);
    sHTML = sHTML.replace(/align=['"]*middle['"]*/gi, 'align="center"');
    if (this.encodeIO) {
        sHTML = encodeHTMLCode(sHTML)
    }
    return sHTML
}function getHTMLBody() {
    var a = eval("idContent" + this.oName);
    this.cleanDeprecated();
    sHTML = a.document.body.innerHTML;
    sHTML = String(sHTML).replace(/ contentEditable=true/g, "");
    sHTML = String(sHTML).replace(/\<PARAM NAME=\"Play\" VALUE=\"0\">/ig, '<PARAM NAME="Play" VALUE="-1">');
    sHTML = oUtil.replaceSpecialChar(sHTML);
    sHTML = sHTML.replace(/align=['"]*middle['"]*/gi, 'align="center"');
    if (this.encodeIO) {
        sHTML = encodeHTMLCode(sHTML)
    }
    return sHTML
}
var sBaseHREF = "";

function getXHTML() {
    var a = eval("idContent" + this.oName);
    this.cleanDeprecated();
    sHTML = a.document.documentElement.outerHTML;
    var b = sHTML.match(/<BASE([^>]*)>/ig);
    if (b != null) {
        sBaseHREF = b[0]
    }
    for (var i = 0; i < a.document.all.length; i++) {
        if (a.document.all[i].tagName == "BASE") {
            a.document.all[i].removeNode()
        }
    }
    for (var i = 0; i < a.document.all.length; i++) {
        if (a.document.all[i].tagName == "BASE") {
            a.document.all[i].removeNode()
        }
    }
    sBaseHREF = sBaseHREF.replace(/<([^ >]*)/ig, function (x) {
        return x.toLowerCase()
    });
    sBaseHREF = sBaseHREF.replace(/ [^=]+="[^"]+"/ig, function (x) {
        x = x.replace(/\s+/ig, "#_#");
        x = x.replace(/^#_#/, " ");
        return x
    });
    sBaseHREF = sBaseHREF.replace(/ ([^=]+)=([^" >]+)/ig, ' $1="$2"');
    sBaseHREF = sBaseHREF.replace(/ ([^=]+)=/ig, function (x) {
        return x.toLowerCase()
    });
    sBaseHREF = sBaseHREF.replace(/#_#/ig, " ");
    sBaseHREF = sBaseHREF.replace(/>$/ig, " />").replace(/\/ \/>$/ig, "/>");
    sHTML = recur(a.document.documentElement, "");
    sHTML = this.docType + this.html + sHTML + "\n</html>";
    sHTML = sHTML.replace(/<\/title>/, "</title>" + sBaseHREF);
    sHTML = oUtil.replaceSpecialChar(sHTML);
    sHTML = sHTML.replace(/align=['"]*middle['"]*/gi, 'align="center"');
    if (this.encodeIO) {
        sHTML = encodeHTMLCode(sHTML)
    }
    return sHTML
}function getXHTMLBody() {
    var a = eval("idContent" + this.oName);
    this.cleanDeprecated();
    sHTML = a.document.documentElement.outerHTML;
    var b = sHTML.match(/<BASE([^>]*)>/ig);
    if (b != null) {
        sBaseHREF = b[0]
    }
    for (var i = 0; i < a.document.all.length; i++) {
        if (a.document.all[i].tagName == "BASE") {
            a.document.all[i].removeNode()
        }
    }
    for (var i = 0; i < a.document.all.length; i++) {
        if (a.document.all[i].tagName == "BASE") {
            a.document.all[i].removeNode()
        }
    }
    sHTML = recur(a.document.body, "");
    sHTML = oUtil.replaceSpecialChar(sHTML);
    sHTML = sHTML.replace(/align=['"]*middle['"]*/gi, 'align="center"');
    if (this.encodeIO) {
        sHTML = encodeHTMLCode(sHTML)
    }
    return sHTML
}function ApplyExternalStyle(a) {
    var b = eval("idContent" + a);
    var c = "";
    for (var j = 0; j < b.document.styleSheets.length; j++) {
        var d = b.document.styleSheets[j];
        for (var i = 0; i < d.rules.length; i++) {
            sSelector = d.rules.item(i).selectorText;
            sCssText = d.rules.item(i).style.cssText.replace(/"/g, "&quot;");
            if (sSelector.match(/table\./gi)) {
                continue
            }
            var e = sSelector.split(".").length;
            if (e > 1) {
                sCaption = sSelector.split(".")[1];
                c += ',["' + sSelector + '",true,"' + sCaption + '","' + sCssText + '"]'
            } else {
                c += ',["' + sSelector + '",false,"","' + sCssText + '"]'
            }
        }
    }
    var f = eval("[" + c.substr(1) + "]");
    var g = eval(a);
    for (var i = 0; i < f.length; i++) {
        for (var j = 0; j < g.arrStyle.length; j++) {
            if (f[i][0].toLowerCase() == g.arrStyle[j][0].toLowerCase()) {
                f[i][1] = g.arrStyle[j][1]
            }
        }
    }
    g.arrStyle = f
}function doApplyStyle(a, b) {
    if (!eval(a).checkFocus()) {
        return
    }
    var c = eval("idContent" + a);
    var d = c.document.selection.createRange();
    eval(a).saveForUndo();
    if (oUtil.activeElement) {
        oElement = oUtil.activeElement;
        oElement.className = b
    } else {
        if (d.parentElement) {
            if (d.text == "") {
                oElement = d.parentElement();
                if (oElement.tagName == "BODY") {
                    return
                }
                oElement.className = b
            } else {
                eval(a).applySpanStyle([], b)
            }
        } else {
            oElement = d.item(0);
            oElement.className = b
        }
    }
    realTime(a)
}function openStyleSelect() {
    if (!this.isCssLoaded) {
        ApplyExternalStyle(this.oName)
    }
    this.isCssLoaded = true;
    var k = false;
    var e = document.getElementById("idStyles" + this.oName);
    if (e.innerHTML != "") {
        if (e.style.display == "") {
            e.style.display = "none"
        } else {
            e.style.display = ""
        }
        return
    }
    e.style.display = "";
    var d = document.getElementById("idContent" + this.oName).offsetHeight - 27;
    var l = this.arrStyle;
    var g = "";
    g += "<div unselectable=on style='width:200px;margin:1px;margin-top:0;margin-right:2px;' align=right>";
    g += "<table style='margin-right:1px;margin-bottom:3px;width:14px;height:14px;background:#f4f4f4;' cellpadding=0 cellspacing=0 unselectable=on><tr><td onclick=\"" + this.oName + ".openStyleSelect();\" onmouseover=\"this.style.border='#708090 1px solid';this.style.color='white';this.style.backgroundColor='9FA7BB'\" onmouseout=\"this.style.border='white 1px solid';this.style.color='black';this.style.backgroundColor=''\" style=\"cursor:default;padding:1px;border:white 1px solid;font-family:verdana;font-size:10px;font-color:black;line-height:9px;\" align=center valign=top unselectable=on>x</td></tr></table></div>";
    var c = "";
    for (var b = 0; b < l.length; b++) {
        sSelector = l[b][0];
        if (sSelector == "BODY") {
            c = l[b][3]
        }
    }
    g += "<div unselectable=on style='overflow:auto;width:200px;height:" + d + "px;padding-left:3px;'>";
    g += "<table name='tblStyles" + this.oName + "' id='tblStyles" + this.oName + "' cellpadding=0 cellspacing=0 style='background:#fcfcfc;" + c + ";width:100%;height:100%;margin:0;'>";
    for (var b = 0; b < l.length; b++) {
        sSelector = l[b][0];
        isOnSelection = l[b][1];
        sCssText = l[b][3];
        sCaption = l[b][2];
        if (isOnSelection) {
            if (sSelector.split(".").length > 1) {
                var a = sSelector;
                if (sSelector.indexOf(":") > 0) {
                    a = sSelector.substring(0, sSelector.indexOf(":"))
                }
                k = true;
                g += "<tr style=\"cursor:default\" onmouseover=\"if(this.style.marginRight!='1px'){this.style.background='" + this.styleSelectionHoverBg + "';this.style.color='" + this.styleSelectionHoverFg + "'}\" onmouseout=\"if(this.style.marginRight!='1px'){this.style.background='';this.style.color=''}\">";
                g += "<td unselectable=on onclick=\"doApplyStyle('" + this.oName + "','" + a.split(".")[1] + "')\" style='padding:2px;'>";
                if (sSelector.split(".")[0] == "") {
                    g += '<span unselectable=on style="' + sCssText + ';margin:0;">' + sCaption + "</span>"
                } else {
                    g += '<span unselectable=on style="' + sCssText + ';margin:0;">' + sSelector + "</span>"
                }
                g += "</td></tr>"
            }
        }
    }
    g += "<tr><td height=50%>&nbsp;</td></tr></table></div>";
    if (k) {
        document.getElementById("idStyles" + this.oName).innerHTML = g
    } else {
        alert("No stylesheet found.")
    }
}function editorDoc_onkeyup(a) {
    if (eval(a).isAfterPaste) {
        eval(a).cleanDeprecated();
        eval(a).runtimeBorder(false);
        eval(a).runtimeStyles();
        eval(a).isAfterPaste = false
    }
    var b = eval(a);
    if (b.tmKeyup) {
        clearTimeout(b.tmKeyup);
        b.tmKeyup = null
    }
    if (!b.tmKeyup) {
        b.tmKeyup = setTimeout(function () {
            realTime(a)
        }, 1000)
    }
    b.bookmarkSelection()
}function editorDoc_onmouseup(a) {
    oUtil.activeElement = null;
    oUtil.oName = a;
    oUtil.oEditor = eval("idContent" + a);
    oUtil.obj = eval(a);
    eval(a).hide();
    realTime(a);
    oUtil.obj.bookmarkSelection()
}function setActiveEditor(a) {
    oUtil.oName = a;
    oUtil.oEditor = eval("idContent" + a);
    oUtil.obj = eval(a)
}
var arrTmp = [];

function GetElement(b, a) {
    while (b != null && b.tagName != a) {
        if (b.tagName == "BODY") {
            return null
        }
        b = b.parentElement
    }
    return b
}
var arrTmp2 = [];

function realTime(a, b) {
    if (!eval(a).checkFocus()) {
        return
    }
    var c = eval("idContent" + a);
    var d = c.document.selection.createRange();
    var f = eval(a);
    var g = f.tbar;
    var h = null;
    if (f.btnTable) {
        var h = g.btns["btnTableEdit" + a];
        var j = isDDs[h.ddId];
        j.enableItem("mnuTableSize" + a, true);
        j.enableItem("mnuTableEdit" + a, true);
        j.enableItem("mnuCellEdit" + a, true);
        var k = (d.parentElement != null ? GetElement(d.parentElement(), "TABLE") : GetElement(d.item(0), "TABLE"));
        if (k) {
            j.enableItem("mnuCellEdit" + a, false);
            h.setState(1)
        } else {
            h.setState(5)
        }
        var l = (d.parentElement != null ? GetElement(d.parentElement(), "TD") : GetElement(d.item(0), "TD"));
        if (l) {
            j.enableItem("mnuCellEdit" + a, true)
        }
    }
    var m = c.document;
    if (f.btnParagraph) {
        h = g.btns["btnParagraph" + a];
        h.setState(m.queryCommandEnabled("FormatBlock") ? 1 : 5)
    }
    if (f.btnFontName) {
        h = g.btns["btnFontName" + a];
        h.setState(m.queryCommandEnabled("FontName") ? 1 : 5)
    }
    if (f.btnFontSize) {
        h = g.btns["btnFontSize" + a];
        h.setState(m.queryCommandEnabled("FontSize") ? 1 : 5)
    }
    if (f.btnCut) {
        h = g.btns["btnCut" + a];
        h.setState(m.queryCommandEnabled("Cut") ? 1 : 5)
    }
    if (f.btnCopy) {
        h = g.btns["btnCopy" + a];
        h.setState(m.queryCommandEnabled("Copy") ? 1 : 5)
    }
    if (f.btnPaste) {
        h = g.btns["btnPaste" + a];
        h.setState(m.queryCommandEnabled("Paste") ? 1 : 5)
    }
    if (f.btnUndo) {
        h = g.btns["btnUndo" + a];
        h.setState(!f.arrUndoList[0] ? 5 : 1)
    }
    if (f.btnRedo) {
        h = g.btns["btnRedo" + a];
        h.setState(!f.arrRedoList[0] ? 5 : 1)
    }
    if (f.btnBold) {
        h = g.btns["btnBold" + a];
        h.setState(m.queryCommandEnabled("Bold") ? (m.queryCommandState("Bold") ? 4 : 1) : 5)
    }
    if (f.btnItalic) {
        h = g.btns["btnItalic" + a];
        h.setState(m.queryCommandEnabled("Italic") ? (m.queryCommandState("Italic") ? 4 : 1) : 5)
    }
    if (f.btnUnderline) {
        h = g.btns["btnUnderline" + a];
        h.setState(m.queryCommandEnabled("Underline") ? (m.queryCommandState("Underline") ? 4 : 1) : 5)
    }
    if (f.btnStrikethrough) {
        h = g.btns["btnStrikethrough" + a];
        h.setState(m.queryCommandEnabled("Strikethrough") ? (m.queryCommandState("Strikethrough") ? 4 : 1) : 5)
    }
    if (f.btnSuperscript) {
        h = g.btns["btnSuperscript" + a];
        h.setState(m.queryCommandEnabled("Superscript") ? (m.queryCommandState("Superscript") ? 4 : 1) : 5)
    }
    if (f.btnSubscript) {
        h = g.btns["btnSubscript" + a];
        h.setState(m.queryCommandEnabled("Subscript") ? (m.queryCommandState("Subscript") ? 4 : 1) : 5)
    }
    if (f.btnNumbering) {
        h = g.btns["btnNumbering" + a];
        h.setState(m.queryCommandEnabled("InsertOrderedList") ? (m.queryCommandState("InsertOrderedList") ? 4 : 1) : 5)
    }
    if (f.btnBullets) {
        h = g.btns["btnBullets" + a];
        h.setState(m.queryCommandEnabled("InsertUnorderedList") ? (m.queryCommandState("InsertUnorderedList") ? 4 : 1) : 5)
    }
    if (f.btnJustifyLeft) {
        h = g.btns["btnJustifyLeft" + a];
        h.setState(m.queryCommandEnabled("JustifyLeft") ? (m.queryCommandState("JustifyLeft") ? 4 : 1) : 5)
    }
    if (f.btnJustifyCenter) {
        h = g.btns["btnJustifyCenter" + a];
        h.setState(m.queryCommandEnabled("JustifyCenter") ? (m.queryCommandState("JustifyCenter") ? 4 : 1) : 5)
    }
    if (f.btnJustifyRight) {
        h = g.btns["btnJustifyRight" + a];
        h.setState(m.queryCommandEnabled("JustifyRight") ? (m.queryCommandState("JustifyRight") ? 4 : 1) : 5)
    }
    if (f.btnJustifyFull) {
        h = g.btns["btnJustifyFull" + a];
        h.setState(m.queryCommandEnabled("JustifyFull") ? (m.queryCommandState("JustifyFull") ? 4 : 1) : 5)
    }
    if (f.btnIndent) {
        h = g.btns["btnIndent" + a];
        h.setState(m.queryCommandEnabled("Indent") ? 1 : 5)
    }
    if (f.btnOutdent) {
        h = g.btns["btnOutdent" + a];
        h.setState(m.queryCommandEnabled("Outdent") ? 1 : 5)
    }
    if (f.btnLTR) {
        h = g.btns["btnLTR" + a];
        h.setState(m.queryCommandEnabled("BlockDirLTR") ? (m.queryCommandState("BlockDirLTR") ? 4 : 1) : 5)
    }
    if (f.btnRTL) {
        h = g.btns["btnRTL" + a];
        h.setState(m.queryCommandEnabled("BlockDirRTL") ? (m.queryCommandState("BlockDirRTL") ? 4 : 1) : 5)
    }
    var v = (d.parentElement ? 1 : 5);
    if (f.btnForeColor) {
        g.btns["btnForeColor" + a].setState(v)
    }
    if (f.btnBackColor) {
        g.btns["btnBackColor" + a].setState(v)
    }
    if (f.btnLine) {
        g.btns["btnLine" + a].setState(v)
    }
    try {
        oUtil.onSelectionChanged()
    } catch (e) {}
    var n = document.getElementById("idStyles" + a);
    if (n.innerHTML != "") {
        var o;
        if (oUtil.activeElement) {
            o = oUtil.activeElement
        } else {
            if (d.parentElement) {
                o = d.parentElement()
            } else {
                o = d.item(0)
            }
        }
        var p = o.className;
        var q = document.getElementById("tblStyles" + a).rows;
        for (var i = 0; i < q.length - 1; i++) {
            sClass = q[i].childNodes[0].innerText;
            if (sClass.split(".").length > 1 && sClass != "") {
                sClass = sClass.split(".")[1]
            }
            if (p == sClass) {
                q[i].style.marginRight = "1px";
                q[i].style.backgroundColor = f.styleSelectionHoverBg;
                q[i].style.color = f.styleSelectionHoverFg
            } else {
                q[i].style.marginRight = "";
                q[i].style.backgroundColor = "";
                q[i].style.color = ""
            }
        }
    }
    if (f.useTagSelector && !b) {
        if (d.parentElement) {
            o = d.parentElement()
        } else {
            o = d.item(0)
        }
        var r = "";
        var i = 0;
        arrTmp2 = [];
        while (o != null && o.tagName != "BODY") {
            arrTmp2[i] = o;
            var s = o.tagName;
            r = "&nbsp; &lt;<span id=tag" + a + i + " unselectable=on style='text-decoration:underline;cursor:pointer' onclick=\"" + a + ".selectElement(" + i + ')">' + s + "</span>&gt;" + r;
            o = o.parentElement;
            i++
        }
        r = "&nbsp;&lt;BODY&gt;" + r;
        eval("idElNavigate" + a).innerHTML = r;
        eval("idElCommand" + a).style.display = "none"
    }
    if (f.isAfterPaste) {
        f.cleanDeprecated();
        f.runtimeBorder(false);
        f.runtimeStyles();
        f.isAfterPaste = false
    }
}function realtimeFontSelect(a) {
    var b = eval("idContent" + a);
    var c = b.document.queryCommandValue("FontName");
    var d = eval(a);
    var e = false;
    for (var i = 0; i < d.arrFontName.length; i++) {
        if (c == d.arrFontName[i]) {
            e = true;
            break
        }
    }
    if (e) {
        isDDs["ddFontName" + a].selectItem("btnFontName_" + i + a, true)
    } else {
        isDDs["ddFontName" + a].clearSelection()
    }
}function realtimeSizeSelect(a) {
    var b = eval("idContent" + a);
    var c = b.document.queryCommandValue("FontSize");
    var d = eval(a);
    var e = false;
    for (var i = 0; i < d.arrFontSize.length; i++) {
        if (c == d.arrFontSize[i][1]) {
            e = true;
            break
        }
    }
    if (e) {
        isDDs["ddFontSize" + a].selectItem("btnFontSize_" + i + a, true)
    } else {
        isDDs["ddFontSize" + a].clearSelection()
    }
}function moveTagSelector() {
    var a = "<table unselectable=on ondblclick='" + this.oName + ".moveTagSelector()' width='100%' cellpadding=0 cellspacing=0 style='border:#cfcfcf 1px solid;border-bottom:none'><tr style='background:#f8f8f8;font-family:arial;font-size:10px;color:black;'><td id=idElNavigate" + this.oName + " style='padding:1px;width:100%;' valign=top>&nbsp;</td><td align=right valign='center' nowrap><span id=idElCommand" + this.oName + " unselectable=on style='vertical-align:middle;display:none;text-decoration:underline;cursor:pointer;padding-right:5;' onclick='" + this.oName + ".removeTag()'>" + getTxt("Remove Tag") + "</span></td></tr></table>";
    var b = "<table unselectable=on ondblclick='" + this.oName + ".moveTagSelector()' width='100%' cellpadding=0 cellspacing=0 style='border-left:#cfcfcf 1px solid;border-right:#cfcfcf 1px solid;'><tr style='background-color:#f8f8f8;font-family:arial;font-size:10px;color:black;'><td id=idElNavigate" + this.oName + " style='padding:1px;width:100%;' valign=top>&nbsp;</td><td align=right valign='center' nowrap><span id=idElCommand" + this.oName + " unselectable=on style='vertical-align:middle;display:none;text-decoration:underline;cursor:pointer;padding-right:5;' onclick='" + this.oName + ".removeTag()'>" + getTxt("Remove Tag") + "</span></td></tr></table>";
    if (this.TagSelectorPosition == "top") {
        eval("idTagSelTop" + this.oName).innerHTML = "";
        eval("idTagSelBottom" + this.oName).innerHTML = b;
        eval("idTagSelTopRow" + this.oName).style.display = "none";
        eval("idTagSelBottomRow" + this.oName).style.display = "block";
        this.TagSelectorPosition = "bottom"
    } else {
        eval("idTagSelTop" + this.oName).innerHTML = a;
        eval("idTagSelBottom" + this.oName).innerHTML = "";
        eval("idTagSelTopRow" + this.oName).style.display = "block";
        eval("idTagSelBottomRow" + this.oName).style.display = "none";
        this.TagSelectorPosition = "top"
    }
}function selectElement(i) {
    var a = eval("idContent" + this.oName);
    var b = a.document.body.createControlRange();
    var c;
    try {
        b.add(arrTmp2[i]);
        b.select();
        realTime(this.oName, true);
        c = arrTmp2[i];
        if (c.tagName != "TD" && c.tagName != "TR" && c.tagName != "TBODY" && c.tagName != "LI") {
            eval("idElCommand" + this.oName).style.display = ""
        }
    } catch (e) {
        try {
            var b = a.document.body.createTextRange();
            b.moveToElementText(arrTmp2[i]);
            b.select();
            realTime(this.oName, true);
            c = arrTmp2[i];
            if (c.tagName != "TD" && c.tagName != "TR" && c.tagName != "TBODY" && c.tagName != "LI") {
                eval("idElCommand" + this.oName).style.display = ""
            }
        } catch (e) {
            return
        }
    }
    for (var j = 0; j < arrTmp2.length; j++) {
        eval("tag" + this.oName + j).style.background = ""
    }
    eval("tag" + this.oName + i).style.background = "DarkGray";
    if (c) {
        oUtil.activeElement = c
    }
}function removeTag() {
    if (!this.checkFocus()) {
        return
    }
    eval(this.oName).saveForUndo();
    var a = eval("idContent" + this.oName);
    var b = a.document.selection.createRange();
    var c = a.document.selection.type;
    if (c == "Control") {
        b.item(0).outerHTML = "";
        this.focus();
        realTime(this.oName);
        return
    }
    var d = oUtil.activeElement;
    var e = a.document.body.createTextRange();
    e.moveToElementText(d);
    b.setEndPoint("StartToStart", e);
    b.setEndPoint("EndToEnd", e);
    b.select();
    this.saveForUndo();
    sHTML = d.innerHTML;
    sHTML = fixPathEncode(sHTML);
    var f = d.parentElement;
    if (f.innerHTML == d.outerHTML) {
        f.innerHTML = sHTML;
        fixPathDecode(a);
        var e = a.document.body.createTextRange();
        e.moveToElementText(f);
        b.setEndPoint("StartToStart", e);
        b.setEndPoint("EndToEnd", e);
        b.select();
        realTime(this.oName);
        this.selectElement(0);
        return
    } else {
        d.outerHTML = "";
        b.pasteHTML(sHTML);
        fixPathDecode(a);
        this.focus();
        realTime(this.oName)
    }
    this.runtimeBorder(false);
    this.runtimeStyles()
}function runtimeBorderOn() {
    this.runtimeBorderOff();
    var a = eval("idContent" + this.oName);
    var b = a.document.getElementsByTagName("TABLE");
    for (i = 0; i < b.length; i++) {
        var c = b[i];
        if (c.border == 0) {
            var d = c.getElementsByTagName("TD");
            for (j = 0; j < d.length; j++) {
                if (d[j].style.borderLeftWidth == "0px" || d[j].style.borderLeftWidth == "" || d[j].style.borderLeftWidth == "medium") {
                    d[j].runtimeStyle.borderLeftWidth = 1;
                    d[j].runtimeStyle.borderLeftColor = "#BCBCBC";
                    d[j].runtimeStyle.borderLeftStyle = "dotted"
                }
                if (d[j].style.borderRightWidth == "0px" || d[j].style.borderRightWidth == "" || d[j].style.borderRightWidth == "medium") {
                    d[j].runtimeStyle.borderRightWidth = 1;
                    d[j].runtimeStyle.borderRightColor = "#BCBCBC";
                    d[j].runtimeStyle.borderRightStyle = "dotted"
                }
                if (d[j].style.borderTopWidth == "0px" || d[j].style.borderTopWidth == "" || d[j].style.borderTopWidth == "medium") {
                    d[j].runtimeStyle.borderTopWidth = 1;
                    d[j].runtimeStyle.borderTopColor = "#BCBCBC";
                    d[j].runtimeStyle.borderTopStyle = "dotted"
                }
                if (d[j].style.borderBottomWidth == "0px" || d[j].style.borderBottomWidth == "" || d[j].style.borderBottomWidth == "medium") {
                    d[j].runtimeStyle.borderBottomWidth = 1;
                    d[j].runtimeStyle.borderBottomColor = "#BCBCBC";
                    d[j].runtimeStyle.borderBottomStyle = "dotted"
                }
            }
        }
    }
}function runtimeBorderOff() {
    var a = eval("idContent" + this.oName);
    var b = a.document.getElementsByTagName("TABLE");
    for (i = 0; i < b.length; i++) {
        var c = b[i];
        if (c.border == 0) {
            var d = c.getElementsByTagName("TD");
            for (j = 0; j < d.length; j++) {
                d[j].runtimeStyle.borderWidth = "";
                d[j].runtimeStyle.borderColor = "";
                d[j].runtimeStyle.borderStyle = ""
            }
        }
    }
}function runtimeBorder(a) {
    if (a) {
        if (this.IsRuntimeBorderOn) {
            this.runtimeBorderOff();
            this.IsRuntimeBorderOn = false
        } else {
            this.runtimeBorderOn();
            this.IsRuntimeBorderOn = true
        }
    } else {
        if (this.IsRuntimeBorderOn) {
            this.runtimeBorderOn()
        } else {
            this.runtimeBorderOff()
        }
    }
}function runtimeStyles() {
    var a = eval("idContent" + this.oName);
    var b = a.document.getElementsByTagName("FORM");
    for (i = 0; i < b.length; i++) {
        b[i].runtimeStyle.border = "#7bd158 1px dotted"
    }
    var c = a.document.getElementsByTagName("A");
    for (i = 0; i < c.length; i++) {
        var d = c[i];
        if (d.name || d.NAME) {
            if (d.innerHTML == "") {
                d.runtimeStyle.width = "1px"
            }
            d.runtimeStyle.padding = "0px";
            d.runtimeStyle.paddingLeft = "1px";
            d.runtimeStyle.paddingRight = "1px";
            d.runtimeStyle.border = "#888888 1px dotted";
            d.runtimeStyle.borderLeft = "#cccccc 10px solid"
        }
    }
}function cleanFonts() {
    var a = eval("idContent" + this.oName);
    var b = a.document.body.getElementsByTagName("FONT");
    if (b.length == 0) {
        return false
    }
    var f;
    while (b.length > 0) {
        f = b[0];
        if (f.hasChildNodes && f.childNodes.length == 1 && f.childNodes[0].nodeType == 1 && f.childNodes[0].nodeName == "SPAN") {
            copyAttribute(f.childNodes[0], f);
            f.removeNode(false)
        } else {
            if (f.parentElement.nodeName == "SPAN" && f.parentElement.childNodes.length == 1) {
                copyAttribute(f.parentElement, f);
                f.removeNode(false)
            } else {
                var c = a.document.createElement("SPAN");
                copyAttribute(c, f);
                var d = f.innerHTML;
                d = fixPathEncode(d);
                c.innerHTML = d;
                f.replaceNode(c);
                fixPathDecode(a)
            }
        }
    }
    return true
}function cleanTags(a, b) {
    var c = eval("idContent" + this.oName);
    var f;
    while (a.length > 0) {
        f = a[0];
        if (f.hasChildNodes && f.childNodes.length == 1 && f.childNodes[0].nodeType == 1 && f.childNodes[0].nodeName == "SPAN") {
            if (b == "bold") {
                f.childNodes[0].style.fontWeight = "bold"
            }
            if (b == "italic") {
                f.childNodes[0].style.fontStyle = "italic"
            }
            if (b == "line-through") {
                f.childNodes[0].style.textDecoration = "line-through"
            }
            if (b == "underline") {
                f.childNodes[0].style.textDecoration = "underline"
            }
            f.removeNode(false)
        } else {
            if (f.parentElement.nodeName == "SPAN" && f.parentElement.childNodes.length == 1) {
                if (b == "bold") {
                    f.parentElement.style.fontWeight = "bold"
                }
                if (b == "italic") {
                    f.parentElement.style.fontStyle = "italic"
                }
                if (b == "line-through") {
                    f.parentElement.style.textDecoration = "line-through"
                }
                if (b == "underline") {
                    f.parentElement.style.textDecoration = "underline"
                }
                f.removeNode(false)
            } else {
                var d = c.document.createElement("SPAN");
                if (b == "bold") {
                    d.style.fontWeight = "bold"
                }
                if (b == "italic") {
                    d.style.fontStyle = "italic"
                }
                if (b == "line-through") {
                    d.style.textDecoration = "line-through"
                }
                if (b == "underline") {
                    d.style.textDecoration = "underline"
                }
                var e = f.innerHTML;
                e = fixPathEncode(e);
                d.innerHTML = e;
                f.replaceNode(d);
                fixPathDecode(c)
            }
        }
    }
}function replaceTags(a, b) {
    var c = eval("idContent" + this.oName);
    var d = c.document.getElementsByTagName(a);
    var e;
    var g = d.length;
    while (g > 0) {
        f = d[0];
        e = c.document.createElement(b);
        var h = f.innerHTML;
        h = fixPathEncode(h);
        e.innerHTML = h;
        f.replaceNode(e);
        fixPathDecode(c);
        g--
    }
}function cleanDeprecated() {
    var a = eval("idContent" + this.oName);
    var b;
    b = a.document.body.getElementsByTagName("STRIKE");
    this.cleanTags(b, "line-through");
    b = a.document.body.getElementsByTagName("S");
    this.cleanTags(b, "line-through");
    b = a.document.body.getElementsByTagName("U");
    this.cleanTags(b, "underline");
    this.replaceTags("DIR", "DIV");
    this.replaceTags("MENU", "DIV");
    this.replaceTags("CENTER", "DIV");
    this.replaceTags("XMP", "PRE");
    this.replaceTags("BASEFONT", "SPAN");
    b = a.document.body.getElementsByTagName("APPLET");
    var c = b.length;
    while (c > 0) {
        f = b[0];
        f.removeNode(false);
        c--
    }
    this.cleanFonts();
    this.cleanEmptySpan();
    return true
}function applyBold() {
    if (!this.checkFocus()) {
        return
    }
    var a = eval("idContent" + this.oName);
    var b = a.document.selection.createRange();
    this.saveForUndo();
    this.doCmd("bold");
    return;
    var c = a.document.queryCommandState("Bold");
    if (oUtil.activeElement) {
        oElement = oUtil.activeElement
    } else {
        if (b.parentElement) {
            if (b.text == "") {
                oElement = b.parentElement();
                if (oElement.tagName == "BODY") {
                    return
                }
            } else {
                if (c) {
                    this.applySpanStyle([
                        ["fontWeight", ""]
                    ]);
                    this.cleanEmptySpan()
                } else {
                    this.applySpanStyle([
                        ["fontWeight", "bold"]
                    ])
                }
                if (c == a.document.queryCommandState("Bold") && c == true) {
                    this.applySpanStyle([
                        ["fontWeight", "normal"]
                    ])
                }
                return
            }
        } else {
            oElement = b.item(0)
        }
    }
    if (c) {
        oElement.style.fontWeight = ""
    } else {
        oElement.style.fontWeight = "bold"
    }
    if (c == a.document.queryCommandState("Bold") && c == true) {
        oElement.style.fontWeight = "normal"
    }
}function applyItalic() {
    if (!this.checkFocus()) {
        return
    }
    var a = eval("idContent" + this.oName);
    var b = a.document.selection.createRange();
    this.saveForUndo();
    this.doCmd("italic");
    return;
    var c = a.document.queryCommandState("Italic");
    if (oUtil.activeElement) {
        oElement = oUtil.activeElement
    } else {
        if (b.parentElement) {
            if (b.text == "") {
                oElement = b.parentElement();
                if (oElement.tagName == "BODY") {
                    return
                }
            } else {
                if (c) {
                    this.applySpanStyle([
                        ["fontStyle", ""]
                    ]);
                    this.cleanEmptySpan()
                } else {
                    this.applySpanStyle([
                        ["fontStyle", "italic"]
                    ])
                }
                if (c == a.document.queryCommandState("Italic") && c == true) {
                    this.applySpanStyle([
                        ["fontStyle", "normal"]
                    ])
                }
                return
            }
        } else {
            oElement = b.item(0)
        }
    }
    if (c) {
        oElement.style.fontStyle = ""
    } else {
        oElement.style.fontStyle = "italic"
    }
    if (c == a.document.queryCommandState("Italic") && c == true) {
        oElement.style.fontStyle = "normal"
    }
}function GetUnderlinedTag(a) {
    while (a != null && a.style.textDecoration.indexOf("underline") == -1) {
        if (a.tagName == "BODY") {
            return null
        }
        a = a.parentElement
    }
    return a
}function GetOverlinedTag(a) {
    while (a != null && a.style.textDecoration.indexOf("line-through") == -1) {
        if (a.tagName == "BODY") {
            return null
        }
        a = a.parentElement
    }
    return a
}function applyLine(a) {
    if (!this.checkFocus()) {
        return
    }
    var b = eval("idContent" + this.oName);
    var c = b.document.selection.createRange();
    this.saveForUndo();
    if (!c.parentElement) {
        return
    }
    var d = b.document.queryCommandState("Underline");
    var e = b.document.queryCommandState("Strikethrough");
    if (d && !e) {
        if (a == "underline") {
            oElement = GetUnderlinedTag(c.parentElement());
            if (oElement) {
                oElement.style.textDecoration = oElement.style.textDecoration.replace("underline", "")
            }
        } else {
            if (c.text == "") {
                oElement = c.parentElement();
                oElement.style.textDecoration = oElement.style.textDecoration + " line-through"
            } else {
                this.applySpanStyle([
                    ["textDecoration", "line-through"]
                ])
            }
        }
    } else {
        if (e && !d) {
            if (a == "line-through") {
                oElement = GetOverlinedTag(c.parentElement());
                if (oElement) {
                    oElement.style.textDecoration = oElement.style.textDecoration.replace("line-through", "")
                }
            } else {
                if (c.text == "") {
                    oElement = c.parentElement();
                    oElement.style.textDecoration = oElement.style.textDecoration + " underline"
                } else {
                    this.applySpanStyle([
                        ["textDecoration", "underline"]
                    ])
                }
            }
        } else {
            if (d && e) {
                if (a == "underline") {
                    oElement = GetUnderlinedTag(c.parentElement());
                    if (oElement) {
                        oElement.style.textDecoration = oElement.style.textDecoration.replace("underline", "")
                    }
                } else {
                    oElement = GetOverlinedTag(c.parentElement());
                    if (oElement) {
                        oElement.style.textDecoration = oElement.style.textDecoration.replace("line-through", "")
                    }
                }
            } else {
                if (a == "underline") {
                    if (c.text == "") {
                        oElement = c.parentElement();
                        if (oElement.tagName == "BODY") {
                            return
                        }
                        oElement.style.textDecoration = "underline"
                    } else {
                        this.applySpanStyle([
                            ["textDecoration", "underline"]
                        ])
                    }
                } else {
                    if (c.text == "") {
                        oElement = c.parentElement();
                        if (oElement.tagName == "BODY") {
                            return
                        }
                        oElement.style.textDecoration = "line-through"
                    } else {
                        this.applySpanStyle([
                            ["textDecoration", "line-through"]
                        ])
                    }
                }
            }
        }
    }
    return;
    var f = b.document.queryCommandState("Underline");
    var g = b.document.queryCommandState("Strikethrough");
    var h;
    if (a == "underline") {
        if (f && g) {
            h = "line-through"
        } else {
            if (!f && g) {
                h = "underline line-through"
            } else {
                if (f && !g) {
                    h = ""
                } else {
                    if (!f && !g) {
                        h = "underline"
                    }
                }
            }
        }
    } else {
        if (f && g) {
            h = "underline"
        } else {
            if (!f && g) {
                h = ""
            } else {
                if (f && !g) {
                    h = "underline line-through"
                } else {
                    if (!f && !g) {
                        h = "line-through"
                    }
                }
            }
        }
    }
    if (oUtil.activeElement) {
        oElement = oUtil.activeElement
    } else {
        if (c.parentElement) {
            if (c.text == "") {
                oElement = c.parentElement();
                if (oElement.tagName == "BODY") {
                    return
                }
            } else {
                if (h == "") {
                    this.applySpanStyle([
                        ["textDecoration", ""]
                    ]);
                    this.cleanEmptySpan()
                } else {
                    this.applySpanStyle([
                        ["textDecoration", h]
                    ])
                }
                if ((a == "underline" && f == b.document.queryCommandState("Underline") && f == true) || (a == "line-through" && g == b.document.queryCommandState("Strikethrough") && g == true)) {
                    this.applySpanStyle([
                        ["textDecoration", ""]
                    ]);
                    this.cleanEmptySpan()
                }
                return
            }
        } else {
            oElement = c.item(0)
        }
    }
    oElement.style.textDecoration = h;
    if ((a == "underline" && f == b.document.queryCommandState("Underline") && f == true) || (a == "line-through" && g == b.document.queryCommandState("Strikethrough") && g == true)) {
        this.applySpanStyle([
            ["textDecoration", ""]
        ]);
        this.cleanEmptySpan()
    }
}function applyColor(a, b) {
    if (!this.checkFocus()) {
        return
    }
    this.hide();
    var c = eval("idContent" + this.oName);
    var d = c.document.selection.createRange();
    this.saveForUndo();
    if (oUtil.activeElement) {
        oElement = oUtil.activeElement;
        if (a == "ForeColor") {
            oElement.style.color = b
        } else {
            oElement.style.backgroundColor = b
        }
    } else {
        if (d.parentElement) {
            if (d.text == "") {
                oElement = d.parentElement();
                if (oElement.tagName == "BODY") {
                    return
                }
                if (a == "ForeColor") {
                    oElement.style.color = b
                } else {
                    oElement.style.backgroundColor = b
                }
            } else {
                if (a == "ForeColor") {
                    this.applySpanStyle([
                        ["color", b]
                    ])
                } else {
                    this.applySpanStyle([
                        ["backgroundColor", b]
                    ])
                }
            }
        }
    }
    if (b == "") {
        this.cleanEmptySpan();
        realTime(this.oName)
    }
}function applyFontName(a) {
    this.hide();
    if (!this.checkFocus()) {
        return
    }
    var b = eval("idContent" + this.oName);
    var c = b.document.selection.createRange();
    this.hide();
    c.select();
    this.saveForUndo();
    if (c.parentElement) {
        var d = b.document.body.createTextRange();
        var e = b.document.getElementsByTagName("SPAN");
        for (var i = 0; i < e.length; i++) {
            d.moveToElementText(e[i]);
            if (c.inRange(d)) {
                e[i].style.fontFamily = a
            }
        }
    }
    this.doCmd("fontname", a);
    replaceWithSpan(b);
    realTime(this.oName)
}function applyFontSize(a) {
    this.hide();
    if (!this.checkFocus()) {
        return
    }
    var b = eval("idContent" + this.oName);
    var c = b.document.selection.createRange();
    this.hide();
    c.select();
    this.saveForUndo();
    if (c.parentElement) {
        var d = b.document.body.createTextRange();
        var e = b.document.getElementsByTagName("SPAN");
        for (var i = 0; i < e.length; i++) {
            d.moveToElementText(e[i]);
            if (c.inRange(d)) {
                if (a == 1) {
                    e[i].style.fontSize = "8pt"
                } else {
                    if (a == 2) {
                        e[i].style.fontSize = "10pt"
                    } else {
                        if (a == 3) {
                            e[i].style.fontSize = "12pt"
                        } else {
                            if (a == 4) {
                                e[i].style.fontSize = "14pt"
                            } else {
                                if (a == 5) {
                                    e[i].style.fontSize = "18pt"
                                } else {
                                    if (a == 6) {
                                        e[i].style.fontSize = "24pt"
                                    } else {
                                        if (a = 7) {
                                            e[i].style.fontSize = "36pt"
                                        }
                                    }
                                }
                            }
                        }
                    }
                }
            }
        }
    }
    this.doCmd("fontsize", a);
    replaceWithSpan(b);
    realTime(this.oName)
}function applySpanStyle(a, b) {
    var c = eval("idContent" + this.oName);
    var d = c.document.selection.createRange();
    this.hide();
    d.select();
    this.saveForUndo();
    if (d.parentElement) {
        var e = c.document.body.createTextRange();
        var f = d.parentElement();
        var g = c.document.getElementsByTagName("SPAN");
        for (var i = 0; i < g.length; i++) {
            e.moveToElementText(g[i]);
            if (d.inRange(e)) {
                copyStyleClass(g[i], a, b)
            }
        }
    }
    this.doCmd("fontname", "");
    replaceWithSpan(c, a, b);
    this.cleanEmptySpan();
    realTime(this.oName)
}function doClean() {
    if (!this.checkFocus()) {
        return
    }
    var a = eval("idContent" + this.oName);
    this.saveForUndo();
    this.doCmd("RemoveFormat");
    if (oUtil.activeElement) {
        var b = oUtil.activeElement;
        b.removeAttribute("className", 0);
        b.removeAttribute("style", 0);
        if (b.tagName == "H1" || b.tagName == "H2" || b.tagName == "H3" || b.tagName == "H4" || b.tagName == "H5" || b.tagName == "H6" || b.tagName == "PRE" || b.tagName == "P" || b.tagName == "DIV") {
            if (this.useDIV) {
                this.doCmd("FormatBlock", "<DIV>")
            } else {
                this.doCmd("FormatBlock", "<P>")
            }
        }
    } else {
        var c = a.document.selection.createRange();
        var d = a.document.selection.type;
        if (c.parentElement) {
            if (c.text == "") {
                oEl = c.parentElement();
                if (oEl.tagName == "BODY") {
                    return
                } else {
                    oEl.removeAttribute("className", 0);
                    oEl.removeAttribute("style", 0);
                    if (oEl.tagName == "H1" || oEl.tagName == "H2" || oEl.tagName == "H3" || oEl.tagName == "H4" || oEl.tagName == "H5" || oEl.tagName == "H6" || oEl.tagName == "PRE" || oEl.tagName == "P" || oEl.tagName == "DIV") {
                        if (this.useDIV) {
                            this.doCmd("FormatBlock", "<DIV>")
                        } else {
                            this.doCmd("FormatBlock", "<P>")
                        }
                    }
                }
            } else {
                this.applySpanStyle([
                    ["backgroundColor", ""],
                    ["color", ""],
                    ["fontFamily", ""],
                    ["fontSize", ""],
                    ["fontWeight", ""],
                    ["fontStyle", ""],
                    ["textDecoration", ""],
                    ["letterSpacing", ""],
                    ["verticalAlign", ""],
                    ["textTransform", ""],
                    ["fontVariant", ""]
                ], "");
                return
            }
        } else {
            oEl = c.item(0);
            oEl.removeAttribute("className", 0);
            oEl.removeAttribute("style", 0)
        }
    }
    this.cleanEmptySpan();
    realTime(this.oName)
}function cleanEmptySpan() {
    var a = false;
    var b = eval("idContent" + this.oName);
    var c = b.document.getElementsByTagName("SPAN");
    if (c.length == 0) {
        return false
    }
    var d = [];
    var e = /<\s*SPAN\s*>/gi;
    for (var i = 0; i < c.length; i++) {
        if (c[i].outerHTML.search(e) == 0) {
            d[d.length] = c[i]
        }
    }
    var f, theParent;
    for (var i = 0; i < d.length; i++) {
        f = d[i];
        f.removeNode(false);
        a = true
    }
    return a
}function copyStyleClass(b, d, a) {
    if (d) {
        for (var c = 0; c < d.length; c++) {
            b.style[d[c][0]] = d[c][1]
        }
    }
    if (b.style.fontFamily == "") {
        b.style.cssText = b.style.cssText.replace("FONT-FAMILY: ; ", "");
        b.style.cssText = b.style.cssText.replace("FONT-FAMILY: ", "")
    }
    if (a != null) {
        b.className = a;
        if (b.className == "") {
            b.removeAttribute("className", 0)
        }
    }
}function copyAttribute(b, c) {
    if ((c.face != null) && (c.face != "")) {
        b.style.fontFamily = c.face
    }
    if ((c.size != null) && (c.size != "")) {
        var a = "";
        if (c.size == 1) {
            a = "8pt"
        } else {
            if (c.size == 2) {
                a = "10pt"
            } else {
                if (c.size == 3) {
                    a = "12pt"
                } else {
                    if (c.size == 4) {
                        a = "14pt"
                    } else {
                        if (c.size == 5) {
                            a = "18pt"
                        } else {
                            if (c.size == 6) {
                                a = "24pt"
                            } else {
                                if (c.size >= 7) {
                                    a = "36pt"
                                } else {
                                    if (c.size <= -2 || c.size == "0") {
                                        a = "8pt"
                                    } else {
                                        if (c.size == "-1") {
                                            a = "10pt"
                                        } else {
                                            if (c.size == 0) {
                                                a = "12pt"
                                            } else {
                                                if (c.size == "+1") {
                                                    a = "14pt"
                                                } else {
                                                    if (c.size == "+2") {
                                                        a = "18pt"
                                                    } else {
                                                        if (c.size == "+3") {
                                                            a = "24pt"
                                                        } else {
                                                            if (c.size == "+4" || c.size == "+5" || c.size == "+6") {
                                                                a = "36pt"
                                                            } else {
                                                                a = ""
                                                            }
                                                        }
                                                    }
                                                }
                                            }
                                        }
                                    }
                                }
                            }
                        }
                    }
                }
            }
        }
        if (a != "") {
            b.style.fontSize = a
        }
    }
    if ((c.style.backgroundColor != null) && (c.style.backgroundColor != "")) {
        b.style.backgroundColor = c.style.backgroundColor
    }
    if ((c.color != null) && (c.color != "")) {
        b.style.color = c.color
    }
    if ((c.className != null) && (c.className != "")) {
        b.className = c.className
    }
}function replaceWithSpan(a, b, c) {
    var d = a.document.selection.createRange();
    var e;
    d.select();
    var g = d.text.length;
    var h = new Array();
    if (d.parentElement().nodeName == "FONT" && d.parentElement().innerText == d.text) {
        d.moveToElementText(d.parentElement());
        h[0] = d.parentElement()
    } else {
        h = a.document.getElementsByTagName("FONT")
    }
    var i = a.document.body.createTextRange();
    var l, f;
    var m = h.length;
    while (m > 0) {
        f = h[0];
        if (f == null || f.parentElement == null) {
            m--;
            continue
        }
        i.moveToElementText(f);
        var n = "f";
        var o = 0;
        while (eval(n + ".parentElement")) {
            o++;
            n += ".parentElement"
        }
        var p = false;
        for (var j = o; j > 0; j--) {
            n = "f";
            for (var k = 1; k <= j; k++) {
                n += ".parentElement"
            }
            if (!p) {
                if (eval(n).nodeName == "SPAN" && eval(n).innerText == f.innerText) {
                    l = eval(n);
                    if (b || c) {
                        copyStyleClass(l, b, c)
                    } else {
                        copyAttribute(l, f)
                    }
                    f.removeNode(false);
                    p = true
                }
            }
        }
        if (p) {
            continue
        }
        l = a.document.createElement("SPAN");
        if (b || c) {
            copyStyleClass(l, b, c)
        } else {
            copyAttribute(l, f)
        }
        var q = f.innerHTML;
        q = fixPathEncode(q);
        l.innerHTML = q;
        f.replaceNode(l);
        fixPathDecode(a);
        m--;
        if (!e) {
            e = l
        }
    }
    var r = a.document.selection.createRange();
    if (e) {
        r.moveToElementText(e);
        r.select()
    }
    r.moveEnd("character", g - r.text.length);
    r.select();
    r.moveEnd("character", g - r.text.length);
    r.select();
    r.moveEnd("character", g - r.text.length);
    r.select()
}function doOnPaste() {
    this.isAfterPaste = true;
    this.saveForUndo();
    if (this.pasteTextOnCtrlV == true) {
        this.doPasteText();
        return false
    }
}function doPaste() {
    this.saveForUndo();
    if (this.pasteTextOnCtrlV == true) {
        this.doOnPaste()
    } else {
        this.doCmd("Paste")
    }
    this.runtimeBorder(false)
}function doCmd(a, b) {
    if (!this.checkFocus()) {
        return
    }
    if (a == "Cut" || a == "Copy" || a == "Superscript" || a == "Subscript" || a == "Indent" || a == "Outdent" || a == "InsertHorizontalRule" || a == "BlockDirLTR" || a == "BlockDirRTL") {
        this.saveForUndo()
    }
    var c = eval("idContent" + this.oName);
    var d = c.document.selection.createRange();
    var e = c.document.selection.type;
    var f = (e == "None" ? c.document : d);
    f.execCommand(a, false, b);
    realTime(this.oName)
}function applyParagraph(a) {
    this.hide();
    if (!this.checkFocus()) {
        return
    }
    var b = eval("idContent" + this.oName);
    var c = b.document.selection.createRange();
    this.hide();
    c.select();
    this.saveForUndo();
    this.doCmd("FormatBlock", a)
}function applyBullets() {
    if (!this.checkFocus()) {
        return
    }
    this.saveForUndo();
    this.doCmd("InsertUnOrderedList");
    this.tbar.btns["btnNumbering" + this.oName].setState(1);
    var a = eval("idContent" + this.oName);
    var b = a.document.selection.createRange();
    var c = b.parentElement();
    while (c != null && c.tagName != "OL" && c.tagName != "UL") {
        if (c.tagName == "BODY") {
            return
        }
        c = c.parentElement
    }
    c.removeAttribute("type", 0);
    c.style.listStyleImage = ""
}function applyNumbering() {
    if (!this.checkFocus()) {
        return
    }
    this.saveForUndo();
    this.doCmd("InsertOrderedList");
    this.tbar.btns["btnBullets" + this.oName].setState(1);
    var a = eval("idContent" + this.oName);
    var b = a.document.selection.createRange();
    var c = b.parentElement();
    while (c != null && c.tagName != "OL" && c.tagName != "UL") {
        if (c.tagName == "BODY") {
            return
        }
        c = c.parentElement
    }
    c.removeAttribute("type", 0);
    c.style.listStyleImage = ""
}function applyJustifyLeft() {
    if (!this.checkFocus()) {
        return
    }
    this.saveForUndo();
    this.doCmd("JustifyLeft")
}function applyJustifyCenter() {
    if (!this.checkFocus()) {
        return
    }
    this.saveForUndo();
    this.doCmd("JustifyCenter")
}function applyJustifyRight() {
    if (!this.checkFocus()) {
        return
    }
    this.saveForUndo();
    this.doCmd("JustifyRight")
}function applyJustifyFull() {
    if (!this.checkFocus()) {
        return
    }
    this.saveForUndo();
    this.doCmd("JustifyFull")
}function applyBlockDirLTR() {
    if (!this.checkFocus()) {
        return
    }
    this.doCmd("BlockDirLTR")
}function applyBlockDirRTL() {
    if (!this.checkFocus()) {
        return
    }
    this.doCmd("BlockDirRTL")
}function doPasteText() {
    if (!this.checkFocus()) {
        return
    }
    var a = eval("idContentWord" + this.oName);
    a.document.open("text/html", "replace");
    a.document.write("<html><head></head><body></body></html>");
    a.document.close();
    a.document.body.contentEditable = true;
    var b = eval("idContent" + this.oName);
    var c = b.document.selection.createRange();
    this.saveForUndo();
    var a = eval("idContentWord" + this.oName);
    a.focus();
    a.document.execCommand("SelectAll");
    a.document.execCommand("Paste");
    var d = a.document.body.innerHTML;
    d = d.replace(/(<br>)/gi, "$1&lt;REPBR&gt;");
    d = d.replace(/(<\/tr>)/gi, "$1&lt;REPBR&gt;");
    d = d.replace(/(<\/div>)/gi, "$1&lt;REPBR&gt;");
    d = d.replace(/(<\/h1>)/gi, "$1&lt;REPBR&gt;");
    d = d.replace(/(<\/h2>)/gi, "$1&lt;REPBR&gt;");
    d = d.replace(/(<\/h3>)/gi, "$1&lt;REPBR&gt;");
    d = d.replace(/(<\/h4>)/gi, "$1&lt;REPBR&gt;");
    d = d.replace(/(<\/h5>)/gi, "$1&lt;REPBR&gt;");
    d = d.replace(/(<\/h6>)/gi, "$1&lt;REPBR&gt;");
    d = d.replace(/(<p>)/gi, "$1&lt;REPBR&gt;");
    d = fixPathEncode(d);
    a.document.body.innerHTML = d;
    fixPathDecode(a);
    d = a.document.body.innerText.replace(/<REPBR>/gi, "<br />");
    d = d.replace(/[\n\t\r]/gi, "");
    d = d.replace(/>\s*</gi, "><");
    c.pasteHTML(d)
}function insertCustomTag(a) {
    this.hide();
    if (!this.checkFocus()) {
        return
    }
    this.insertHTML(this.arrCustomTag[a][1]);
    this.hide();
    this.focus()
}function insertHTML(a) {
    this.setFocus();
    if (!this.checkFocus()) {
        return
    }
    var b = eval("idContent" + this.oName);
    var c = b.document.selection.createRange();
    this.saveForUndo();
    var d = String(a).match(/<A[^>]*>/ig);
    if (d) {
        for (var i = 0; i < d.length; i++) {
            sTmp = d[i].replace(/href=/, "href_iwe=");
            a = String(a).replace(d[i], sTmp)
        }
    }
    var e = String(a).match(/<IMG[^>]*>/ig);
    if (e) {
        for (var i = 0; i < e.length; i++) {
            sTmp = e[i].replace(/src=/, "src_iwe=");
            a = String(a).replace(e[i], sTmp)
        }
    }
    a = a.replace(/[\n\t\r]/gi, "");
    a = a.replace(/>\s*</gi, "><");
    if (c.parentElement) {
        c.pasteHTML("<span id='iwe_delete'>toberemoved</span>" + a)
    } else {
        c.item(0).outerHTML = a
    }
    var f = b.document.getElementById("iwe_delete");
    if (f) {
        f.removeNode(true)
    }
    for (var i = 0; i < b.document.all.length; i++) {
        var g = b.document.all[i];
        if (g.nodeType == 1) {
            if (g.getAttribute("href_iwe")) {
                g.href = g.getAttribute("href_iwe");
                g.removeAttribute("href_iwe", 0)
            }
            if (g.getAttribute("src_iwe")) {
                g.src = g.getAttribute("src_iwe");
                g.removeAttribute("src_iwe", 0)
            }
        }
    }
    this.bookmarkSelection()
}function insertLink(a, b, c, d) {
    this.setFocus();
    if (!this.checkFocus()) {
        return
    }
    var e = eval("idContent" + this.oName);
    var f = e.document.selection.createRange();
    this.saveForUndo();
    if (f.parentElement) {
        if (f.text == "") {
            var g = f.duplicate();
            if (b != "" && b != undefined) {
                f.text = b
            } else {
                f.text = a
            }
            f.setEndPoint("StartToStart", g);
            f.select()
        }
    }
    f.execCommand("CreateLink", false, a);
    if (f.parentElement) {
        oEl = GetElement(f.parentElement(), "A")
    } else {
        oEl = GetElement(f.item(0), "A")
    }
    if (oEl) {
        if (c != "" && c != undefined) {
            oEl.target = c
        }
        if (d != "" && d != undefined) {
            oEl.setAttribute("rel", d)
        }
    }
    this.bookmarkSelection()
}function clearAll() {
    if (confirm(getTxt("Are you sure you wish to delete all contents?")) == true) {
        var a = eval("idContent" + this.oName);
        this.saveForUndo();
        a.document.body.innerHTML = ""
    }
}function applySpan() {
    if (!this.checkFocus()) {
        return
    }
    var a = eval("idContent" + this.oName);
    var b = a.document.selection.createRange();
    var c = a.document.selection.type;
    if (c == "Control" || c == "None") {
        return
    }
    sHTML = b.htmlText;
    var d = b.parentElement();
    if (d) {
        if (d.innerText == b.text) {
            if (d.tagName == "SPAN") {
                g = d;
                return g
            }
        }
    }
    var e = String(sHTML).match(/<A[^>]*>/ig);
    if (e) {
        for (var i = 0; i < e.length; i++) {
            sTmp = e[i].replace(/href=/, "href_iwe=");
            sHTML = String(sHTML).replace(e[i], sTmp)
        }
    }
    var f = String(sHTML).match(/<IMG[^>]*>/ig);
    if (f) {
        for (var i = 0; i < f.length; i++) {
            sTmp = f[i].replace(/src=/, "src_iwe=");
            sHTML = String(sHTML).replace(f[i], sTmp)
        }
    }
    b.pasteHTML("<SPAN id='idSpan__abc'>" + sHTML + "</SPAN>");
    var g = a.document.all.idSpan__abc;
    var h = a.document.body.createTextRange();
    h.moveToElementText(g);
    b.setEndPoint("StartToStart", h);
    b.setEndPoint("EndToEnd", h);
    b.select();
    for (var i = 0; i < a.document.all.length; i++) {
        if (a.document.all[i].getAttribute("href_iwe")) {
            a.document.all[i].href = a.document.all[i].getAttribute("href_iwe");
            a.document.all[i].removeAttribute("href_iwe", 0)
        }
        if (a.document.all[i].getAttribute("src_iwe")) {
            a.document.all[i].src = a.document.all[i].getAttribute("src_iwe");
            a.document.all[i].removeAttribute("src_iwe", 0)
        }
    }
    g.removeAttribute("id", 0);
    return g
}function makeAbsolute() {
    if (!this.checkFocus()) {
        return
    }
    var a = eval("idContent" + this.oName);
    var b = a.document.selection.createRange();
    this.saveForUndo();
    if (b.parentElement) {
        var c = b.parentElement();
        c.style.position = "absolute"
    } else {
        this.doCmd("AbsolutePosition")
    }
}function expandSelection() {
    if (!this.checkFocus()) {
        return
    }
    var a = eval("idContent" + this.oName);
    var b = a.document.selection.createRange();
    if (b.text != "") {
        return
    }
    b.expand("word");
    b.select();
    if (b.text.substr(b.text.length * 1 - 1, b.text.length) == " ") {
        b.moveEnd("character", -1);
        b.select()
    }
}function selectParagraph() {
    if (!this.checkFocus()) {
        return
    }
    var a = eval("idContent" + this.oName);
    var b = a.document.selection.createRange();
    if (b.parentElement) {
        if (b.text == "") {
            var c = b.parentElement();
            while (c != null && c.tagName != "H1" && c.tagName != "H2" && c.tagName != "H3" && c.tagName != "H4" && c.tagName != "H5" && c.tagName != "H6" && c.tagName != "PRE" && c.tagName != "P" && c.tagName != "DIV") {
                if (c.tagName == "BODY") {
                    return
                }
                c = c.parentElement
            }
            var d = a.document.body.createControlRange();
            try {
                d.add(c);
                d.select()
            } catch (e) {
                var d = a.document.body.createTextRange();
                try {
                    d.moveToElementText(c);
                    d.select()
                } catch (e) {}
            }
        }
    }
}function doOver_TabCreate() {
    var k = event.srcElement;
    var h = k.parentElement.parentElement.parentElement;
    var c = k.parentElement.rowIndex;
    var g = k.cellIndex;
    var l = h.rows;
    l[l.length - 1].childNodes[0].innerHTML = "<div align=right>" + (c * 1 + 1) + " x " + (g * 1 + 1) + " " + getTxt("Table Dimension Text") + " ...  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span style='text-decoration:underline'>" + getTxt("Table Advance Link") + "</span>&nbsp;</div>";
    for (var e = 0; e < l.length - 1; e++) {
        var a = l[e];
        for (var d = 0; d < a.childNodes.length; d++) {
            var b = a.childNodes[d];
            if (e <= c && d <= g) {
                b.style.backgroundColor = "#316ac5"
            } else {
                b.style.backgroundColor = "#ffffff"
            }
        }
    }
    event.cancelBubble = true
}function doOut_TabCreate() {
    var b = event.srcElement;
    if (b.tagName != "TABLE") {
        return
    }
    var g = b.rows;
    g[g.length - 1].childNodes[0].innerText = getTxt("Advanced Table Insert");
    for (var d = 0; d < g.length - 1; d++) {
        var a = g[d];
        for (var c = 0; c < a.childNodes.length; c++) {
            var e = a.childNodes[c];
            e.style.backgroundColor = "#ffffff"
        }
    }
    event.cancelBubble = true
}function doRefresh_TabCreate() {
    var a = eval("dropTableCreate" + this.oName);
    var b = a.rows;
    b[b.length - 1].childNodes[0].innerText = getTxt("Advanced Table Insert");
    for (var i = 0; i < b.length - 1; i++) {
        var c = b[i];
        for (var j = 0; j < c.childNodes.length; j++) {
            var d = c.childNodes[j];
            d.style.backgroundColor = "#ffffff"
        }
    }
}function doClick_TabCreate() {
    this.hide();
    if (!this.checkFocus()) {
        return
    }
    var a = eval("idContent" + this.oName);
    var b = a.document.selection.createRange();
    var c = event.srcElement;
    var d = c.parentElement.rowIndex + 1;
    var e = c.cellIndex + 1;
    this.saveForUndo();
    var f = "<table style='border-collapse:collapse;width:100%;'>";
    for (var i = 1; i <= d; i++) {
        f += "<tr>";
        for (var j = 1; j <= e; j++) {
            f += "<td></td>"
        }
        f += "</tr>"
    }
    f += "</table>";
    if (b.parentElement) {
        b.collapse();
        b.pasteHTML(f)
    } else {
        b.item(0).outerHTML = f
    }
    realTime(this.oName);
    this.runtimeBorder(false);
    this.runtimeStyles()
}function doKeyPress(a, b) {
    var c = eval(b);
    if (!c.arrUndoList[0]) {
        c.saveForUndo()
    }
    if (a.ctrlKey) {
        if (a.keyCode == 86) {
            c.bookmarkSelection();
            if (c.pasteTextOnCtrlV == true) {} else {
                var d = document.getElementById("idContentWord" + b);
                var e = d.contentWindow.document;
                var f = e.open("text/html", "replace");
                f.close();
                e.body.contentEditable = true;
                d.contentWindow.focus();
                window.setTimeout(function () {
                    c.setFocus();
                    c.fixWord()
                }, 50)
            }
        }
        if (a.keyCode == 89) {
            if (!a.altKey) {
                eval(b).doRedo()
            }
        }
        if (a.keyCode == 90) {
            if (!a.altKey) {
                eval(b).doUndo()
            }
        }
        if (a.keyCode == 65) {
            if (!a.altKey) {
                eval(b).doCmd("SelectAll")
            }
        }
        if (a.keyCode == 66 || a.keyCode == 73 || a.keyCode == 85) {
            if (!a.altKey) {
                eval(b).saveForUndo()
            }
        }
    }
    if (a.keyCode == 37 || a.keyCode == 38 || a.keyCode == 39 || a.keyCode == 40) {
        eval(b).saveForUndo()
    }
    if (a.keyCode == 13) {
        if (eval(b).useDIV && !eval(b).useBR) {
            var g = document.selection.createRange();
            if (g.parentElement) {
                eval(b).saveForUndo();
                if (GetElement(g.parentElement(), "FORM")) {
                    var g = document.selection.createRange();
                    g.pasteHTML("<br>");
                    a.cancelBubble = true;
                    a.returnValue = false;
                    g.select();
                    g.moveEnd("character", 1);
                    g.moveStart("character", 1);
                    g.collapse(false);
                    return false
                } else {
                    var h = GetElement(g.parentElement(), "H1");
                    if (!h) {
                        h = GetElement(g.parentElement(), "H2")
                    }
                    if (!h) {
                        h = GetElement(g.parentElement(), "H3")
                    }
                    if (!h) {
                        h = GetElement(g.parentElement(), "H4")
                    }
                    if (!h) {
                        h = GetElement(g.parentElement(), "H5")
                    }
                    if (!h) {
                        h = GetElement(g.parentElement(), "H6")
                    }
                    if (!h) {
                        h = GetElement(g.parentElement(), "PRE")
                    }
                    if (!h) {
                        eval(b).doCmd("FormatBlock", "<div>")
                    }
                    return true
                }
            }
        }
        if ((eval(b).useDIV && eval(b).useBR) || (!eval(b).useDIV && eval(b).useBR)) {
            var g = document.selection.createRange();
            g.pasteHTML("<br>");
            a.cancelBubble = true;
            a.returnValue = false;
            g.select();
            g.moveEnd("character", 1);
            g.moveStart("character", 1);
            g.collapse(false);
            return false
        }
        eval(b).saveForUndo()
    }
    eval(b).onKeyPress()
}function fullScreen() {
    this.hide();
    var a = eval("idContent" + this.oName);
    if (this.stateFullScreen) {
        this.onNormalScreen();
        this.stateFullScreen = false;
        document.body.style.overflow = "";
        var b = eval("idArea" + this.oName);
        b.style.position = "";
        b.style.top = 0;
        b.style.left = 0;
        var w = new String(this.width);
        if (w.indexOf("%") == -1) {
            w = parseInt(w, 10) + "px"
        }
        b.style.width = w;
        var h = new String(this.height);
        if (h.indexOf("%") == -1) {
            h = parseInt(h, 10) + "px"
        }
        b.style.height = this.height;
        var c = document.getElementById("idFixZIndex" + this.oName);
        c.style.top = 0;
        c.style.left = 0;
        c.style.width = 0;
        c.style.height = 0;
        c.style.display = "none";
        a.document.body.style.lineHeight = "1.2";
        window.setTimeout("eval('idContent" + this.oName + "').document.body.style.lineHeight='';", 0);
        for (var i = 0; i < oUtil.arrEditor.length; i++) {
            if (oUtil.arrEditor[i] != this.oName) {
                eval("idArea" + oUtil.arrEditor[i]).style.display = "block"
            }
        }
    } else {
        this.onFullScreen();
        this.stateFullScreen = true;
        scroll(0, 0);
        var b = eval("idArea" + this.oName);
        b.style.position = "absolute";
        b.style.top = 0;
        b.style.left = 0;
        b.style.zIndex = 2000;
        var d = document.getElementById("idToolbar" + this.oName);
        nToolbarHeight = d.offsetHeight;
        if (this.useTagSelector) {
            nToolbarHeight += 13
        }
        if (this.showResizeBar) {
            nToolbarHeight += 8
        }
        var w = 0,
            h = 0;
        if (isIE9) {
            w = window.innerWidth;
            h = window.innerHeight;
            h = h - nToolbarHeight
        } else {
            if (document.compatMode && document.compatMode != "BackCompat") {
                var f = document.documentElement;
                try {
                    w = (document.body.offsetWidth);
                    document.body.style.height = "100%";
                    h = f.clientHeight - nToolbarHeight;
                    document.body.style.height = ""
                } catch (e) {
                    w = (document.body.offsetWidth + 20);
                    document.body.style.height = "100%";
                    h = f.clientHeight - nToolbarHeight;
                    document.body.style.height = ""
                }
            } else {
                if (document.body.style.overflow == "hidden") {
                    w = document.body.offsetWidth
                } else {
                    w = document.body.offsetWidth - 22
                }
                h = document.body.offsetHeight - 4
            }
        }
        b.style.width = w + "px";
        b.style.height = h + "px";
        var c = document.getElementById("idFixZIndex" + this.oName);
        c.style.top = 0;
        c.style.left = 0;
        c.style.width = w;
        c.style.height = h;
        c.style.display = "";
        c.style.zIndex = 1900;
        for (var i = 0; i < oUtil.arrEditor.length; i++) {
            if (oUtil.arrEditor[i] != this.oName) {
                eval("idArea" + oUtil.arrEditor[i]).style.display = "none"
            }
        }
        a.document.body.style.lineHeight = "1.2";
        window.setTimeout("eval('idContent" + this.oName + "').document.body.style.lineHeight='';", 0);
        a.focus()
    }
    var g = document.getElementById("idStyles" + this.oName);
    g.innerHTML = ""
}function hide() {
    hideAllDD();
    this.oColor1.hide();
    this.oColor2.hide();
    if (this.btnTable) {
        this.doRefresh_TabCreate()
    }
}function convertBorderWidth(a) {
    return eval(a.substr(0, a.length - 2))
}function modelessDialogShow(b, d, a, e, c) {
    windowOpen(b, d, a, false, e, c)
}function modalDialogShow(b, d, a, e, c) {
    windowOpen(b, d, a, true, e, c)
}function windowOpen(a, e, d, c, h, b) {
    var k = "ID" + (new Date()).getTime();
    var g = new ISWindow(k);
    g.iconPath = oUtil.scriptPath + "icons/";
    g.show({
        width: e + "px",
        height: d + "px",
        overlay: c,
        center: true,
        url: a,
        openerWin: h,
        options: b
    })
}function lineBreak1(a) {
    arrReturn = ["\n", "", ""];
    if (a == "A" || a == "B" || a == "CITE" || a == "CODE" || a == "EM" || a == "FONT" || a == "I" || a == "SMALL" || a == "STRIKE" || a == "BIG" || a == "STRONG" || a == "SUB" || a == "SUP" || a == "U" || a == "SAMP" || a == "S" || a == "VAR" || a == "BASEFONT" || a == "KBD" || a == "TT" || a == "SPAN" || a == "IMG") {
        arrReturn = ["", "", ""]
    }
    if (a == "TEXTAREA" || a == "TABLE" || a == "THEAD" || a == "TBODY" || a == "TR" || a == "OL" || a == "UL" || a == "DIR" || a == "MENU" || a == "FORM" || a == "SELECT" || a == "MAP" || a == "DL" || a == "HEAD" || a == "BODY" || a == "HTML") {
        arrReturn = ["\n", "", "\n"]
    }
    if (a == "STYLE" || a == "SCRIPT") {
        arrReturn = ["\n", "", ""]
    }
    if (a == "BR" || a == "HR") {
        arrReturn = ["", "\n", ""]
    }
    return arrReturn
}function fixAttr(a) {
    a = String(a).replace(/&/g, "&amp;");
    a = String(a).replace(/</g, "&lt;");
    a = String(a).replace(/"/g, "&quot;");
    return a
}function fixVal(b) {
    b = String(b).replace(/&/g, "&amp;");
    b = String(b).replace(/</g, "&lt;");
    var a = escape(b);
    a = unescape(a.replace(/\%A0/gi, "-*REPL*-"));
    b = a.replace(/-\*REPL\*-/gi, "&nbsp;");
    return b
}function recur(h, b) {
    var e = "";
    for (var g = 0; g < h.childNodes.length; g++) {
        var q = h.childNodes[g];
        if (q.parentNode != h) {
            continue
        }
        if (q.nodeType == 1) {
            var a = q.nodeName;
            var t = q.outerHTML;
            if (t.indexOf("<?xml:namespace") > -1) {
                t = t.substr(t.indexOf(">") + 1)
            }
            t = t.substring(1, t.indexOf(">"));
            if (t.indexOf(" ") > -1) {
                t = t.substring(0, t.indexOf(" "))
            }
            var o = false;
            if (a.substring(0, 1) == "/") {
                o = true
            } else {
                var d = b;
                e += lineBreak1(a)[0];
                if (lineBreak1(a)[0] != "") {
                    e += d
                }
            }
            if (o) {} else {
                if (a == "OBJECT" || a == "EMBED") {
                    s = getOuterHTML(q);
                    s = s.replace(/\"[^\"]*\"/ig, function (u) {
                        u = u.replace(/&/g, "&amp;").replace(/</g, "&lt;").replace(/>/g, "&gt;").replace(/'/g, "&apos;").replace(/\s+/ig, "#_#").replace(/&amp;amp;/gi, "&amp;");
                        return u
                    });
                    s = s.replace(/<([^ >]*)/ig, function (u) {
                        return u.toLowerCase()
                    });
                    s = s.replace(/ ([^=]+)=([^"' >]+)/ig, ' $1="$2"');
                    s = s.replace(/ ([^=]+)=/ig, function (u) {
                        return u.toLowerCase()
                    });
                    s = s.replace(/#_#/ig, " ");
                    if (a == "EMBED") {
                        if (q.innerHTML == "") {
                            s = s.replace(/>$/ig, " />").replace(/\/ \/>$/ig, "/>")
                        }
                    }
                    s = s.replace(/<param name=\"Play\" value=\"0\" \/>/, '<param name="Play" value="-1" />');
                    e += s
                } else {
                    if (a == "TITLE") {
                        e += "<title>" + q.innerHTML + "</title>"
                    } else {
                        if (a == "AREA") {
                            var c = q.coords;
                            var m = q.shape
                        }
                        if (a == "BODY") {
                            var p = q.outerHTML;
                            if (isIE9) {
                                p = getOuterHTML(q)
                            }
                            s = p.substring(0, p.indexOf(">") + 1)
                        } else {
                            var n = q.cloneNode();
                            if (q.checked) {
                                n.checked = q.checked
                            }
                            if (q.selected) {
                                n.selected = q.selected
                            }
                            s = n.outerHTML.replace(/<\/[^>]*>/, "");
                            if (isIE9) {
                                s = getOuterHTML(n).replace(/<\/[^>]*>/, "")
                            }
                        }
                        if (a == "STYLE") {
                            var l = s.match(/<[^>]*>/ig);
                            s = l[0]
                        }
                        s = s.replace(/\"[^\"]*\"/ig, function (u) {
                            u = u.replace(/&/g, "&amp;").replace(/&amp;amp;/g, "&amp;").replace(/</g, "&lt;").replace(/>/g, "&gt;").replace(/\s+/ig, "#_#");
                            return u
                        });
                        s = s.replace(/<([^ >]*)/ig, function (u) {
                            return u.toLowerCase()
                        });
                        s = s.replace(/ ([^=]+)=([^" >]+)/ig, ' $1="$2"');
                        s = s.replace(/ ([^=]+)=/ig, function (u) {
                            return u.toLowerCase()
                        });
                        s = s.replace(/#_#/ig, " ");
                        s = s.replace(/(<hr[^>]*)(noshade=""|noshade )/ig, '$1noshade="noshade" ');
                        s = s.replace(/(<input[^>]*)(checked=""|checked )/ig, '$1checked="checked" ');
                        s = s.replace(/(<select[^>]*)(multiple=""|multiple )/ig, '$1multiple="multiple" ');
                        s = s.replace(/(<option[^>]*)(selected=""|selected )/ig, '$1selected="true" ');
                        s = s.replace(/(<input[^>]*)(readonly=""|readonly )/ig, '$1readonly="readonly" ');
                        s = s.replace(/(<input[^>]*)(disabled=""|disabled )/ig, '$1disabled="disabled" ');
                        s = s.replace(/(<td[^>]*)(nowrap=""|nowrap )/ig, '$1nowrap="nowrap" ');
                        s = s.replace(/(<td[^>]*)(nowrap=""\>|nowrap\>)/ig, '$1nowrap="nowrap">');
                        s = s.replace(/ contenteditable=\"true\"/ig, "");
                        if (a == "AREA") {
                            s = s.replace(/ coords=\"0,0,0,0\"/ig, ' coords="' + c + '"');
                            s = s.replace(/ shape=\"RECT\"/ig, ' shape="' + m + '"')
                        }
                        var r = true;
                        if (a == "IMG" || a == "BR" || a == "AREA" || a == "HR" || a == "INPUT" || a == "BASE" || a == "LINK") {
                            s = s.replace(/>$/ig, " />").replace(/\/ \/>$/ig, "/>");
                            r = false
                        }
                        e += s;
                        if (a != "TEXTAREA") {
                            e += lineBreak1(a)[1]
                        }
                        if (a != "TEXTAREA") {
                            if (lineBreak1(a)[1] != "") {
                                e += d
                            }
                        }
                        if (r) {
                            s = q.outerHTML;
                            if (a == "SCRIPT") {
                                s = s.replace(/<script([^>]*)>[\n+\s+\t+]*/ig, "<script$1>");
                                s = s.replace(/[\n+\s+\t+]*<\/script>/ig, "<\/script>");
                                s = s.replace(/<script([^>]*)>\/\/<!\[CDATA\[/ig, "");
                                s = s.replace(/\/\/\]\]><\/script>/ig, "");
                                s = s.replace(/<script([^>]*)>/ig, "");
                                s = s.replace(/<\/script>/ig, "");
                                s = s.replace(/^\s+/, "").replace(/\s+$/, "");
                                e += "\n" + d + "//<![CDATA[\n" + d + s + "\n" + d + "//]]>\n" + d
                            }
                            if (a == "STYLE") {
                                s = s.replace(/<style([^>]*)>[\n+\s+\t+]*/ig, "<style$1>");
                                s = s.replace(/[\n+\s+\t+]*<\/style>/ig, "</style>");
                                s = s.replace(/<style([^>]*)><!--/ig, "");
                                s = s.replace(/--><\/style>/ig, "");
                                s = s.replace(/<style([^>]*)>/ig, "");
                                s = s.replace(/<\/style>/ig, "");
                                s = s.replace(/^\s+/, "").replace(/\s+$/, "");
                                e += "\n" + d + "<!--\n" + d + s + "\n" + d + "-->\n" + d
                            }
                            if (a == "DIV" || a == "P") {
                                if (q.innerHTML == "" || q.innerHTML == "&nbsp;") {
                                    e += "&nbsp;"
                                } else {
                                    e += recur(q, d + "\t")
                                }
                            } else {
                                if (a == "STYLE" || a == "SCRIPT") {} else {
                                    e += recur(q, d + "\t")
                                }
                            }
                            if (a != "TEXTAREA") {
                                e += lineBreak1(a)[2]
                            }
                            if (a != "TEXTAREA") {
                                if (lineBreak1(a)[2] != "") {
                                    e += d
                                }
                            }
                            if (t.indexOf(":") >= 0) {
                                e += "</" + t.toLowerCase() + ">"
                            } else {
                                e += "</" + a.toLowerCase() + ">"
                            }
                        }
                    }
                }
            }
        } else {
            if (q.nodeType == 3) {
                e += fixVal(q.nodeValue).replace(/^[\t\r\n\v\f]*/, "").replace(/[\t\r\n\v\f]*$/, "")
            } else {
                if (q.nodeType == 8) {
                    var k = q.nodeValue;
                    k = k.replace(/^\s+/, "").replace(/\s+$/, "");
                    var d = "";
                    e += "\n" + d + "<!--\n" + d + k + "\n" + d + "-->\n" + d
                } else {}
            }
        }
    }
    return e
}function fixPathEncode(b) {
    var e = String(b).match(/<A[^>]*>/g);
    if (e) {
        for (var a = 0; a < e.length; a++) {
            sTmp = e[a].replace(/href=/, "href_iwe=");
            b = String(b).replace(e[a], sTmp)
        }
    }
    var d = String(b).match(/<IMG[^>]*>/g);
    if (d) {
        for (var a = 0; a < d.length; a++) {
            sTmp = d[a].replace(/src=/, "src_iwe=");
            b = String(b).replace(d[a], sTmp)
        }
    }
    var c = String(b).match(/<AREA[^>]*>/ig);
    if (c) {
        for (var a = 0; a < c.length; a++) {
            sTmp = c[a].replace(/href=/, "href_iwe=");
            b = String(b).replace(c[a], sTmp)
        }
    }
    return b
}function fixPathDecode(b) {
    for (var a = 0; a < b.document.all.length; a++) {
        if (b.document.all[a].getAttribute("href_iwe")) {
            b.document.all[a].href = b.document.all[a].getAttribute("href_iwe");
            b.document.all[a].removeAttribute("href_iwe", 0)
        }
        if (b.document.all[a].getAttribute("src_iwe")) {
            b.document.all[a].src = b.document.all[a].getAttribute("src_iwe");
            b.document.all[a].removeAttribute("src_iwe", 0)
        }
    }
}function tbAction(a, b, c, d) {
    var e = c,
        oN = d,
        btn = b.substring(0, b.lastIndexOf(oN));
    switch (btn) {
        case "btnSave":
            e.onSave();
            break;
        case "btnFullScreen":
            e.fullScreen();
            break;
        case "btnPrint":
            e.focus();
            c.doCmd("Print");
            break;
        case "btnSearch":
            e.hide();
            modelessDialogShow(e.scriptPath + "search.htm", 375, 175);
            break;
        case "btnSpellCheck":
            e.hide();
            if (e.spellCheckMode == "ieSpell") {
                modelessDialogShow(e.scriptPath + "spellcheck.htm", 500, 222)
            } else {
                if (e.spellCheckMode == "NetSpell") {
                    checkSpellingById("idContent" + c.oName)
                }
            }
            break;
        case "btnCut":
            e.doCmd("Cut");
            break;
        case "btnCopy":
            e.doCmd("Copy");
            break;
        case "btnUndo":
            e.doUndo();
            break;
        case "btnRedo":
            e.doRedo();
            break;
        case "btnBold":
            e.applyBold();
            break;
        case "btnItalic":
            e.applyItalic();
            break;
        case "btnUnderline":
            e.applyLine("underline");
            break;
        case "btnStrikethrough":
            e.applyLine("line-through");
            break;
        case "btnSuperscript":
            e.doCmd("Superscript");
            break;
        case "btnSubscript":
            e.doCmd("Subscript");
            break;
        case "btnJustifyLeft":
            e.applyJustifyLeft();
            break;
        case "btnJustifyCenter":
            e.applyJustifyCenter();
            break;
        case "btnJustifyRight":
            e.applyJustifyRight();
            break;
        case "btnJustifyFull":
            e.applyJustifyFull();
            break;
        case "btnNumbering":
            e.applyNumbering();
            break;
        case "btnBullets":
            e.applyBullets();
            break;
        case "btnIndent":
            e.doCmd("Indent");
            break;
        case "btnOutdent":
            e.doCmd("Outdent");
            break;
        case "btnLTR":
            e.applyBlockDirLTR();
            break;
        case "btnRTL":
            e.applyBlockDirRTL();
            break;
        case "btnForeColor":
            e.oColor1.show(document.getElementById(b));
            break;
        case "btnBackColor":
            e.oColor2.show(document.getElementById(b));
            break;
        case "btnBookmark":
            e.hide();
            modelessDialogShow(e.scriptPath + "bookmark.htm", 245, 216);
            break;
        case "btnHyperlink":
            e.hide();
            modelessDialogShow(e.scriptPath + "hyperlink.htm", 380, 235);
            break;
        case "btnImage":
            e.hide();
            modelessDialogShow(e.scriptPath + "image.htm", 440, 351);
            break;
        case "btnFlash":
            e.hide();
            modelessDialogShow(e.scriptPath + "flash.htm", 340, 275);
            break;
        case "btnYoutubeVideo":
            e.hide();
            modelessDialogShow(e.scriptPath + "youtube_video.htm", 340, 125);
            break;
        case "btnMedia":
            e.hide();
            modelessDialogShow(e.scriptPath + "media.htm", 340, 272);
            break;
        case "btnContentBlock":
            e.hide();
            eval(e.cmdContentBlock);
            break;
        case "btnInternalLink":
            e.hide();
            eval(e.cmdInternalLink);
            break;
        case "btnInternalImage":
            e.hide();
            eval(e.cmdInternalImage);
            break;
        case "btnCustomObject":
            e.hide();
            eval(e.cmdCustomObject);
            break;
        case "btnGuidelines":
            e.runtimeBorder(true);
            break;
        case "btnAutoTable":
            e.hide();
            modelessDialogShow(e.scriptPath + "table_format.htm", 320, 225);
            break;
        case "btnAbsolute":
            e.makeAbsolute();
            break;
        case "btnCharacters":
            e.hide();
            modelessDialogShow(e.scriptPath + "characters.htm", 495, 162);
            break;
        case "btnLine":
            e.doCmd("InsertHorizontalRule");
            break;
        case "btnRemoveFormat":
            e.doClean();
            break;
        case "btnHTMLFullSource":
            setActiveEditor(oN);
            e.hide();
            modalDialogShow(e.scriptPath + "source_html_full.htm", 800, 600);
            break;
        case "btnHTMLSource":
            setActiveEditor(oN);
            e.hide();
            modalDialogShow(e.scriptPath + "source_html.htm", 800, 600);
            break;
        case "btnXHTMLFullSource":
            setActiveEditor(oN);
            e.hide();
            modalDialogShow(e.scriptPath + "source_xhtml_full.htm", 800, 600);
            break;
        case "btnXHTMLSource":
            setActiveEditor(oN);
            e.hide();
            modalDialogShow(e.scriptPath + "source_xhtml.htm", 800, 600);
            break;
        case "btnClearAll":
            e.clearAll();
            break;
        case "btnStyles":
            e.hide();
            e.openStyleSelect();
            break;
        case "btnParagraph":
            e.hide();
            e.selectParagraph();
            break;
        case "btnFontName":
            e.hide();
            e.expandSelection();
            realtimeFontSelect(e.oName);
            break;
        case "btnFontSize":
            e.hide();
            e.expandSelection();
            realtimeSizeSelect(e.oName);
            break;
        case "btnCustomTag":
            e.hide();
            break;
        default:
            for (var i = 0; i < e.arrCustomButtons.length; i++) {
                if (e.arrCustomButtons[i][0] == btn) {
                    eval(e.arrCustomButtons[i][1]);
                    break
                }
            }
    }
}function ddAction(c, l, k, h) {
    var b = h;
    var g = k;
    var d = l.substring(0, l.lastIndexOf(b));
    switch (d) {
        case "btnPreview1":
            setActiveEditor(b);
            modalDialogShow(g.scriptPath + "preview.htm?w=800&h=600", 800, 600);
            break;
        case "btnPreview2":
            setActiveEditor(b);
            modalDialogShow(g.scriptPath + "preview.htm?w=800&h=600", 800, 600);
            break;
        case "btnPreview3":
            setActiveEditor(b);
            modalDialogShow(g.scriptPath + "preview.htm?w=1024&h=768", 1024, 768);
            break;
        case "btnTextFormatting":
            modelessDialogShow(g.scriptPath + "text1.htm", 511, 490);
            break;
        case "btnParagraphFormatting":
            modelessDialogShow(g.scriptPath + "paragraph.htm", 460, 284);
            break;
        case "btnListFormatting":
            modelessDialogShow(g.scriptPath + "list.htm", 320, 335);
            break;
        case "btnBoxFormatting":
            modelessDialogShow(g.scriptPath + "box.htm", 498, 395);
            break;
        case "btnCssText":
            modelessDialogShow(g.scriptPath + "styles_cssText.htm", 360, 340);
            break;
        case "btnCssBuilder":
            modelessDialogShow(g.scriptPath + "styles_cssText2.htm", 430, 445);
            break;
        case "btnForm0":
            modelessDialogShow(g.scriptPath + "form_form.htm", 280, 177);
            break;
        case "btnForm1":
            modelessDialogShow(g.scriptPath + "form_text.htm", 285, 289);
            break;
        case "btnForm2":
            modelessDialogShow(g.scriptPath + "form_list.htm", 295, 332);
            break;
        case "btnForm3":
            modelessDialogShow(g.scriptPath + "form_check.htm", 235, 174);
            break;
        case "btnForm4":
            modelessDialogShow(g.scriptPath + "form_radio.htm", 235, 177);
            break;
        case "btnForm5":
            modelessDialogShow(g.scriptPath + "form_hidden.htm", 235, 152);
            break;
        case "btnForm6":
            modelessDialogShow(g.scriptPath + "form_file.htm", 235, 132);
            break;
        case "btnForm7":
            modelessDialogShow(g.scriptPath + "form_button.htm", 235, 174);
            break;
        case "mnuTableSize":
            modelessDialogShow(g.scriptPath + "table_size.htm", 240, 282);
            break;
        case "mnuTableEdit":
            modelessDialogShow(g.scriptPath + "table_edit.htm", 400, 430);
            break;
        case "mnuCellEdit":
            modelessDialogShow(g.scriptPath + "table_editCell.htm", 427, 450);
            break;
        case "btnPasteClip":
            g.doPaste();
            break;
        case "btnPasteWord":
            modelessDialogShow(g.scriptPath + "paste_word.htm", 400, 280);
            break;
        case "btnPasteText":
            g.doPasteText();
            break
    }
    var a = 0;
    if (d.indexOf("btnParagraphFormatting") != -1) {} else {
        if (d.indexOf("btnParagraph") != -1) {
            a = d.substr(d.indexOf("_") + 1);
            g.applyParagraph("<" + g.arrParagraph[parseInt(a)][1] + ">")
        } else {
            if (d.indexOf("btnFontName") != -1) {
                a = d.substr(d.indexOf("_") + 1);
                g.applyFontName(g.arrFontName[parseInt(a)])
            } else {
                if (d.indexOf("btnFontSize") != -1) {
                    a = d.substr(d.indexOf("_") + 1);
                    g.applyFontSize(g.arrFontSize[parseInt(a)][1])
                } else {
                    if (d.indexOf("btnCustomTag") != -1) {
                        a = d.substr(d.indexOf("_") + 1);
                        g.insertCustomTag(parseInt(a))
                    }
                }
            }
        }
    }
}function changeHeight(b) {
    var d = String(this.height);
    var c = document.getElementById("idArea" + this.oName);
    if (d.indexOf("%") > -1) {
        d = c.childNodes[0].offsetHeight - c.rows[0].cells[0].childNodes[0].offsetHeight - (this.useTagSelector ? 20 : 0)
    }
    if (!this.minHeight) {
        this.minHeight = parseInt(d, 10)
    }
    var a = parseInt(d, 10) + b;
    this.height = a + "px";
    c.style.height = this.height
}function fixWord() {
    var c = document.getElementById("idContentWord" + this.oName);
    var d = c.contentWindow;
    for (var a = 0; a < d.document.body.all.length; a++) {
        d.document.body.all[a].removeAttribute("class", "", 0);
        d.document.body.all[a].removeAttribute("className", "", 0);
        d.document.body.all[a].removeAttribute("style", "", 0)
    }
    var e = d.document.body.innerHTML;
    e = String(e).replace(/<\\?\?xml[^>]*>/gi, "");
    e = String(e).replace(/<\/?o:p[^>]*>/gi, "");
    e = String(e).replace(/<\/?u1:p[^>]*>/gi, "");
    e = String(e).replace(/<\/?v:[^>]*>/gi, "");
    e = String(e).replace(/<\/?o:[^>]*>/gi, "");
    e = String(e).replace(/<\/?st1:[^>]*>/gi, "");
    e = String(e).replace(/<\/?w:wrap[^>]*>/gi, "");
    e = String(e).replace(/<\/?w:anchorlock[^>]*>/gi, "");
    e = String(e).replace(/&nbsp;/gi, "");
    e = String(e).replace(/<\/?SPAN[^>]*>/gi, "");
    e = String(e).replace(/<\/?FONT[^>]*>/gi, "");
    e = String(e).replace(/<\/?STRONG[^>]*>/gi, "");
    e = String(e).replace(/<\/?H1[^>]*>/gi, "");
    e = String(e).replace(/<\/?H2[^>]*>/gi, "");
    e = String(e).replace(/<\/?H3[^>]*>/gi, "");
    e = String(e).replace(/<\/?H4[^>]*>/gi, "");
    e = String(e).replace(/<\/?H5[^>]*>/gi, "");
    e = String(e).replace(/<\/?H6[^>]*>/gi, "");
    e = String(e).replace(/<\/?P[^>]*><\/P>/gi, "");
    var b = new RegExp(String.fromCharCode(8217), "gi");
    e = String(e).replace(b, "'");
    e = String(e).replace(/  /gi, " ");
    e = String(e).replace(/\n\n/gi, "\n");
    this.insertHTML(e)
}function getOuterHTML(e) {
    var d = "";
    switch (e.nodeType) {
        case 1:
            d = "<" + e.nodeName;
            var g = "";
            for (var b = 0; b < e.attributes.length; b++) {
                if (e.attributes[b].nodeName.substr(0, 4) == "_moz") {
                    continue
                }
                if (e.attributes[b].nodeValue.substr(0, 4) == "_moz") {
                    continue
                }
                if (e.nodeName == "TEXTAREA" && e.attributes[b].nodeName.toLowerCase() == "value") {
                    g = e.attributes[b].nodeValue
                } else {
                    d += " " + e.attributes[b].nodeName + '="' + e.attributes[b].nodeValue.replace(/"/gi, "'") + '"'
                }
            }
            d += ">";
            if (e.nodeName == "TEXTAREA") {
                d += g
            } else {
                if (e.nodeName == "OBJECT") {
                    var c;
                    for (var a = 0; a < e.childNodes.length; a++) {
                        c = e.childNodes[a];
                        if (c.nodeType == 1) {
                            if (c.tagName == "PARAM") {
                                d += '<param name="' + c.name + '" value="' + c.value.replace(/"/gi, "'") + '"/>\n'
                            } else {
                                if (c.tagName == "EMBED") {
                                    d += getOuterHTML(c)
                                }
                            }
                        }
                    }
                } else {
                    d += e.innerHTML
                }
            }
            d += "</" + e.nodeName + ">";
            break;
        case 8:
            d = "<!--" + e.nodeValue + "-->";
            break;
        case 3:
            d = e.nodeValue;
            break
    }
    return d
};