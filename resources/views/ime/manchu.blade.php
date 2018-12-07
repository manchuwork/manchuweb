<!DOCTYPE html>
<html lang="mnc"><!-- Manchu 满语 -->
<head>
    <meta charset="utf-8"/>
    <meta name="description" content="Manchu,满语,满族空间--在线输入法">
    <meta name="keywords" content="Manchu,满语,满族空间--在线输入法">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>满族空间--在线输入法</title>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <link rel="stylesheet" href="/fonts/font-manchu">
    <style>
        /*** Shortcodes Ultimate - box elements ***/

        /*		Common styles
        ---------------------------------------------------------------*/

        .su-clearfix:before,
        .su-clearfix:after {
            display: table;
            content: " ";
        }
        .su-clearfix:after { clear: both; }

        /*		Tabs + Tab
        ---------------------------------------------------------------*/

        .su-tabs {
            margin: 0 0 1.5em 0;
            padding: 3px;
            -webkit-border-radius: 3px;
            -moz-border-radius: 3px;
            border-radius: 3px;
            background: #eee;
        }
        .su-tabs-nav span {
            display: inline-block;
            margin-right: 3px;
            padding: 10px 15px;
            font-size: 13px;
            min-height: 40px;
            line-height: 20px;
            -webkit-border-top-left-radius: 3px;
            -moz-border-radius-topleft: 3px;
            border-top-left-radius: 3px;
            -webkit-border-top-right-radius: 3px;
            -moz-border-radius-topright: 3px;
            border-top-right-radius: 3px;
            color: #333;
            cursor: pointer;
            -webkit-transition: all .2s;
            -moz-transition: all .2s;
            -o-transition: all .2s;
            transition: all .2s;
        }
        .su-tabs-nav span:hover { background: #f5f5f5; }
        .su-tabs-nav span.su-tabs-current { background: #fff; cursor: default; }
        .su-tabs-nav span.su-tabs-disabled {
            opacity: 0.5;
            filter: alpha(opacity=50);
            cursor: default;
        }
        .su-tabs-pane {
            padding: 15px;
            font-size: 13px;
            -webkit-border-bottom-right-radius: 3px;
            -moz-border-radius-bottomright: 3px;
            border-bottom-right-radius: 3px;
            -webkit-border-bottom-left-radius: 3px;
            -moz-border-radius-bottomleft: 3px;
            border-bottom-left-radius: 3px;
            background: #fff;
            color: #333;
        }
        .su-tabs-vertical:before,
        .su-tabs-vertical:after {
            content: " ";
            display: table;
        }
        .su-tabs-vertical:after { clear: both; }
        .su-tabs-vertical .su-tabs-nav {
            float: left;
            width: 30%;
        }
        .su-tabs-vertical .su-tabs-nav span {
            display: block;
            margin-right: 0;
            -webkit-border-radius: 0;
            -moz-border-radius: 0;
            border-radius: 0;
            -webkit-border-top-left-radius: 3px;
            -moz-border-radius-topleft: 3px;
            border-top-left-radius: 3px;
            -webkit-border-bottom-left-radius: 3px;
            -moz-border-radius-bottomleft: 3px;
            border-bottom-left-radius: 3px;
        }
        .su-tabs-vertical .su-tabs-panes {
            float: left;
            width: 70%;
        }
        .su-tabs-vertical .su-tabs-pane {
            -webkit-border-radius: 0;
            -moz-border-radius: 0;
            border-radius: 0;
            -webkit-border-top-right-radius: 3px;
            -webkit-border-bottom-right-radius: 3px;
            -moz-border-radius-topright: 3px;
            -moz-border-radius-bottomright: 3px;
            border-top-right-radius: 3px;
            border-bottom-right-radius: 3px;
        }
        .su-tabs-nav,
        .su-tabs-nav span,
        .su-tabs-panes,
        .su-tabs-pane {
            -webkit-box-sizing: border-box !important;
            -moz-box-sizing: border-box !important;
            box-sizing: border-box !important;
        }
        /* Styles for screens that are less than 768px */
        @media only screen and (max-width: 768px) {
            .su-tabs-nav span { display: block; }
            .su-tabs-vertical .su-tabs-nav {
                float: none;
                width: auto;
            }
            .su-tabs-vertical .su-tabs-panes {
                float: none;
                width: auto;
            }
        }

        /*		Spoiler + Accordion
        ---------------------------------------------------------------*/

        .su-spoiler { margin-bottom: 1.5em; }
        .su-spoiler .su-spoiler:last-child { margin-bottom: 0; }
        .su-accordion { margin-bottom: 1.5em; }
        .su-accordion .su-spoiler { margin-bottom: 0.5em; }
        .su-spoiler-title {
            position: relative;
            cursor: pointer;
            min-height: 20px;
            line-height: 20px;
            padding: 7px 7px 7px 34px;
            font-weight: bold;
            font-size: 13px;
        }
        .su-spoiler-icon {
            position: absolute;
            left: 7px;
            top: 7px;
            display: block;
            width: 20px;
            height: 20px;
            line-height: 21px;
            text-align: center;
            font-size: 14px;
            font-family: FontAwesome;
            font-weight: normal;
            font-style: normal;
            -webkit-font-smoothing: antialiased;
            *margin-right: .3em;
        }
        .su-spoiler-content {
            padding: 14px;
            -webkit-transition: padding-top .2s;
            -moz-transition: padding-top .2s;
            -o-transition: padding-top .2s;
            transition: padding-top .2s;
            -ie-transition: padding-top .2s;
        }
        .su-spoiler.su-spoiler-closed > .su-spoiler-content {
            height: 0;
            margin: 0;
            padding: 0;
            overflow: hidden;
            border: none;
            opacity: 0;
        }
        .su-spoiler-icon-plus .su-spoiler-icon:before { content: "\f068"; }
        .su-spoiler-icon-plus.su-spoiler-closed .su-spoiler-icon:before { content: "\f067"; }
        .su-spoiler-icon-plus-circle .su-spoiler-icon:before { content: "\f056"; }
        .su-spoiler-icon-plus-circle.su-spoiler-closed .su-spoiler-icon:before { content: "\f055"; }
        .su-spoiler-icon-plus-square-1 .su-spoiler-icon:before { content: "\f146"; }
        .su-spoiler-icon-plus-square-1.su-spoiler-closed .su-spoiler-icon:before { content: "\f0fe"; }
        .su-spoiler-icon-plus-square-2 .su-spoiler-icon:before { content: "\f117"; }
        .su-spoiler-icon-plus-square-2.su-spoiler-closed .su-spoiler-icon:before { content: "\f116"; }
        .su-spoiler-icon-arrow .su-spoiler-icon:before { content: "\f063"; }
        .su-spoiler-icon-arrow.su-spoiler-closed .su-spoiler-icon:before { content: "\f061"; }
        .su-spoiler-icon-arrow-circle-1 .su-spoiler-icon:before { content: "\f0ab"; }
        .su-spoiler-icon-arrow-circle-1.su-spoiler-closed .su-spoiler-icon:before { content: "\f0a9"; }
        .su-spoiler-icon-arrow-circle-2 .su-spoiler-icon:before { content: "\f01a"; }
        .su-spoiler-icon-arrow-circle-2.su-spoiler-closed .su-spoiler-icon:before { content: "\f18e"; }
        .su-spoiler-icon-chevron .su-spoiler-icon:before { content: "\f078"; }
        .su-spoiler-icon-chevron.su-spoiler-closed .su-spoiler-icon:before { content: "\f054"; }
        .su-spoiler-icon-chevron-circle .su-spoiler-icon:before { content: "\f13a"; }
        .su-spoiler-icon-chevron-circle.su-spoiler-closed .su-spoiler-icon:before { content: "\f138"; }
        .su-spoiler-icon-caret .su-spoiler-icon:before { content: "\f0d7"; }
        .su-spoiler-icon-caret.su-spoiler-closed .su-spoiler-icon:before { content: "\f0da"; }
        .su-spoiler-icon-caret-square .su-spoiler-icon:before { content: "\f150"; }
        .su-spoiler-icon-caret-square.su-spoiler-closed .su-spoiler-icon:before { content: "\f152"; }
        .su-spoiler-icon-folder-1 .su-spoiler-icon:before { content: "\f07c"; }
        .su-spoiler-icon-folder-1.su-spoiler-closed .su-spoiler-icon:before { content: "\f07b"; }
        .su-spoiler-icon-folder-2 .su-spoiler-icon:before { content: "\f115"; }
        .su-spoiler-icon-folder-2.su-spoiler-closed .su-spoiler-icon:before { content: "\f114"; }
        .su-spoiler-style-default { }
        .su-spoiler-style-default > .su-spoiler-title {
            padding-left: 27px;
            padding-right: 0;
        }
        .su-spoiler-style-default > .su-spoiler-title > .su-spoiler-icon { left: 0; }
        .su-spoiler-style-default > .su-spoiler-content { padding: 1em 0 1em 27px; }
        .su-spoiler-style-fancy {
            border: 1px solid #ccc;
            -webkit-border-radius: 10px;
            -moz-border-radius: 10px;
            border-radius: 10px;
            background: #fff;
            color: #333;
        }
        .su-spoiler-style-fancy > .su-spoiler-title {
            border-bottom: 1px solid #ccc;
            -webkit-border-radius: 10px;
            -moz-border-radius: 10px;
            border-radius: 10px;
            background: #f0f0f0;
            font-size: 0.9em;
        }
        .su-spoiler-style-fancy.su-spoiler-closed > .su-spoiler-title { border: none; }
        .su-spoiler-style-fancy > .su-spoiler-content {
            -webkit-border-radius: 10px;
            -moz-border-radius: 10px;
            border-radius: 10px;
        }
        .su-spoiler-style-simple {
            border-top: 1px solid #ccc;
            border-bottom: 1px solid #ccc;
        }
        .su-spoiler-style-simple > .su-spoiler-title {
            padding: 5px 10px;
            background: #f0f0f0;
            color: #333;
            font-size: 0.9em;
        }
        .su-spoiler-style-simple > .su-spoiler-title > .su-spoiler-icon { display: none; }
        .su-spoiler-style-simple > .su-spoiler-content {
            padding: 1em 10px;
            background: #fff;
            color: #333;
        }

        /*		Quote
        ---------------------------------------------------------------*/

        .su-quote-style-default {
            position: relative;
            margin-bottom: 1.5em;
            padding: 0.5em 3em;
            font-style: italic;
        }
        /*.su-quote-style-default.su-quote-has-cite { margin-bottom: 3em; }*/
        .su-quote-style-default:before,
        .su-quote-style-default:after {
            position: absolute;
            display: block;
            width: 20px;
            height: 20px;
            /*background-image: url('../images/quote.png');*/
            content: '';
        }
        .su-quote-style-default:before {
            top: 0;
            left: 0;
            background-position: 0 0;
        }
        .su-quote-style-default:after {
            right: 0;
            bottom: 0;
            background-position: -20px 0;
        }
        .su-quote-style-default .su-quote-cite {
            display: block;
            text-align: right;
            font-style: normal;
        }
        .su-quote-style-default .su-quote-cite:before { content: "\2014\0000a0"; }
        .su-quote-style-default .su-quote-cite a { text-decoration: underline; }

        /*		Pullquote
        ---------------------------------------------------------------*/

        .su-pullquote {
            display: block;
            width: 30%;
            padding: 0.5em 1em;
        }
        .su-pullquote-align-left {
            margin: 0.5em 1.5em 1em 0;
            padding-left: 0;
            float: left;
            border-right: 5px solid #eee;
        }
        .su-pullquote-align-right {
            margin: 0.5em 0 1em 1.5em;
            padding-right: 0;
            float: right;
            border-left: 5px solid #eee;
        }

        /*		Row + Column
        ---------------------------------------------------------------*/

        .su-row {
            clear: both;
            zoom: 1;
            margin-bottom: 1.5em;
        }
        .su-row:before,
        .su-row:after {
            display: table;
            content: "";
        }
        .su-row:after { clear: both; }
        .su-column {
            display: block;
            margin: 0 4% 0 0;
            float: left;
            -webkit-box-sizing: border-box;
            -moz-box-sizing: border-box;
            box-sizing: border-box;
        }
        .su-column-last { margin-right: 0; }
        .su-row .su-column { margin: 0 0 0 4%; }
        .su-row .su-column.su-column-size-1-1 { margin-left: 0; margin-right: 0; }
        .su-row .su-column:first-child { margin-left: 0; }
        .su-column-centered {
            margin-right: auto !important;
            margin-left: auto !important;
            float: none !important;
        }
        .su-column img,
        .su-column iframe,
        .su-column object,
        .su-column embed { max-width: 100%; }
        @media only screen {
            [class*="su-column"] + [class*="su-column"]:last-child { float: right; }
        }
        .su-column-size-1-1 { width: 100%; }
        .su-column-size-1-2 { width: 48%; }
        .su-column-size-1-3 { width: 30.66%; }
        .su-column-size-2-3 { width: 65.33%; }
        .su-column-size-1-4 { width: 22%; }
        .su-column-size-3-4 { width: 74%; }
        .su-column-size-1-5 { width: 16.8%; }
        .su-column-size-2-5 { width: 37.6%; }
        .su-column-size-3-5 { width: 58.4%; }
        .su-column-size-4-5 { width: 79.2%; }
        .su-column-size-1-6 { width: 13.33%; }
        .su-column-size-5-6 { width: 82.66%; }
        /* Styles for screens that are less than 768px */
        @media only screen and (max-width: 768px) {
            .su-column {
                width: 100% !important;
                margin: 0 0 1.5em 0 !important;
                float: none !important;
            }
            .su-row .su-column:last-child {
                margin-bottom: 0 !important;
            }
        }

        /*		Service
        ---------------------------------------------------------------*/

        .su-service {
            position: relative;
            margin: 0 0 1.5em 0;
        }
        .su-service-title {
            display: block;
            margin-bottom: 0.5em;
            color: #333;
            font-weight: bold;
            font-size: 1.1em;
        }
        .su-service-title img {
            position: absolute;
            top: 0;
            left: 0;
            display: block !important;
            margin: 0 !important;
            padding: 0 !important;
            border: none !important;
            -webkit-box-shadow: none !important;
            -moz-box-shadow: none !important;
            box-shadow: none !important;
        }
        .su-service-title i {
            position: absolute;
            top: 0;
            left: 0;
            display: block !important;
            width: 1em;
            height: 1em;
            text-align: center;
            line-height: 1em;
        }
        .su-service-content { line-height: 1.4; }

        /*		Box
        ---------------------------------------------------------------*/

        .su-box {
            margin: 0 0 1.5em 0;
            border-width: 2px;
            border-style: solid;
        }
        .su-box-title {
            display: block;
            padding: 0.5em 1em;
            font-weight: bold;
            font-size: 1.1em;
        }
        .su-box-content {
            background-color: #fff;
            color: #444;
            padding: 1em;
        }
        .su-box-style-soft .su-box-title {
            background-image: url('../images/styles/style-soft.png');
            background-position: 0 0;
            background-repeat: repeat-x;
        }
        .su-box-style-glass .su-box-title {
            background-image: url('../images/styles/style-glass.png');
            background-position: 0 50%;
            background-repeat: repeat-x;
        }
        .su-box-style-bubbles .su-box-title {
            background-image: url('../images/styles/style-bubbles.png');
            background-position: 0 50%;
            background-repeat: repeat-x;
        }
        .su-box-style-noise .su-box-title {
            background-image: url('../images/styles/style-noise.png');
            background-position: 0 0;
            background-repeat: repeat-x;
        }

        /*		Note
        ---------------------------------------------------------------*/

        .su-note {
            margin: 0 0 1.5em 0;
            border-width: 1px;
            border-style: solid;
        }
        .su-note-inner {
            padding: 1em;
            border-width: 1px;
            border-style: solid;
        }

        /*		Expand
        ---------------------------------------------------------------*/

        .su-expand { margin: 0 0 1.5em 0; }
        .su-expand-content { overflow: hidden; }
        .su-expand-link {
            margin-top: 0.5em;
            cursor: pointer;
        }
        .su-expand-link:hover {
            opacity: 0.7;
            filter: alpha(opacity=70);
        }
        .su-expand-link a,
        .su-expand-link a:hover,
        .su-expand-link a:active,
        .su-expand-link a:visited,
        .su-expand-link a:focus {
            display: inline;
            text-decoration: none;
            background: transparent;
            border: none;
        }
        .su-expand-link-style-default .su-expand-link a,
        .su-expand-link-style-default .su-expand-link a:hover { text-decoration: none; }
        .su-expand-link-style-underlined .su-expand-link span { text-decoration: underline; }
        .su-expand-link-style-dotted .su-expand-link span { border-bottom: 1px dotted #333; }
        .su-expand-link-style-dashed .su-expand-link span { border-bottom: 1px dashed #333; }
        .su-expand-link-style-button .su-expand-link a {
            display: inline-block;
            margin-top: 0.2em;
            padding: 0.2em 0.4em;
            border: 2px solid #333;
        }
        .su-expand-link-more { display: none; }
        .su-expand-link-less { display: block; }
        .su-expand-collapsed .su-expand-link-more { display: block; }
        .su-expand-collapsed .su-expand-link-less { display: none; }
        .su-expand-link i {
            display: inline-block;
            margin: 0 0.3em 0 0;
            vertical-align: middle;
            color: inherit;
        }
        .su-expand-link img {
            display: inline-block;
            width: 1em;
            height: 1em;
            margin: 0 0.3em 0 0;
            vertical-align: middle;
        }

        /*		Lightbox content
        ---------------------------------------------------------------*/

        .su-lightbox-content {
            position: relative;
            margin: 0 auto;
        }
        .mfp-content .su-lightbox-content,
        #su-generator .su-lightbox-content { display: block !important; }
        .su-lightbox-content-preview {
            width: 100%;
            min-height: 300px;
            background: #444;
            overflow: hidden;
        }
        .su-lightbox-content h1,
        .su-lightbox-content h2,
        .su-lightbox-content h3,
        .su-lightbox-content h4,
        .su-lightbox-content h5,
        .su-lightbox-content h6 { color: inherit; }

        /*		Common margin resets for box elements
        ---------------------------------------------------------------*/

        .su-column-inner > *:first-child,
        .su-accordion > *:first-child,
        .su-spoiler-content > *:first-child,
        .su-service-content > *:first-child,
        .su-box-content > *:first-child,
        .su-note-inner > *:first-child,
        .su-expand-content > *:first-child,
        .su-lightbox-content > *:first-child { margin-top: 0; }
        .su-column-inner > *:last-child,
        .su-tabs-pane > *:last-child,
        .su-accordion > *:last-child,
        .su-spoiler-content > *:last-child,
        .su-service-content > *:last-child,
        .su-box-content > *:last-child,
        .su-note-inner > *:last-child,
        .su-expand-content > *:last-child,
        .su-lightbox-content > *:last-child { margin-bottom: 0; }


        input, textarea, select, button, meter, progress {
            -webkit-writing-mode: horizontal-tb !important;
        }

        .iui {
            font-family: 'Manchu Bold';
            font-size: 1em;
            background-color: #f2f2f2;
            writing-mode: vertical-lr;
            -webkit-writing-mode: vertical-lr;
            -moz-writing-mode: vertical-lr;
            -ms-writing-mode: tb-lr;
            display: inline-block;
            word-wrap: break-word;
            -webkit-font-smoothing: antialiased;
            -webkit-text-size-adjust: 100%;
            -webkit-text-orientation: sideways-right;
            text-orientation: sideways-right;
        }
    </style>
    <style>
        /*
Theme Name: LightWord
Theme URI: http://www.lightword-design.com/
Description: Simply clever theme with two or three columns, adsense support, fixed-width, widget-ready and threaded comments. Compatible with WordPress 2.9 and above, valid XHTML & CSS + WP3 ready.
Author: Andrei Luca
Template: lightword
Version: 2.0.0.23
Tags: white, light, two-columns, right-sidebar, fixed-width, theme-options, translation-ready, threaded-comments, custom-header,three-columns
License: GNU General Public License v2.0
License URI: http://www.gnu.org/licenses/gpl-2.0.html
*/

        /* by Mac */
        @font-face {
            font-family: 'Abkai Xanyan';
            src: url('http://abkai.net/fonts/abkai-xanyan.eot');
            src: url('http://abkai.net/fonts/abkai-xanyan.eot?#iefix') format('embedded-opentype'),
            url('http://abkai.net/fonts/abkai-xanyan.woff2') format('woff2'),
            url('http://abkai.net/fonts/abkai-xanyan.woff') format('woff'),
            url('http://abkai.net/fonts/abkai-xanyan.ttf') format('truetype');
            font-weight: normal;
            font-style: normal;
        }

        @font-face {
            font-family: 'Abkai Xanyan';
            src: url('http://abkai.net/fonts/abkai-xanyan.b.eot');
            src: url('http://abkai.net/fonts/abkai-xanyan.b.eot?#iefix') format('embedded-opentype'),
            url('http://abkai.net/fonts/abkai-xanyan.b.woff2') format('woff2'),
            url('http://abkai.net/fonts/abkai-xanyan.b.woff') format('woff'),
            url('http://abkai.net/fonts/abkai-xanyan.b.ttf') format('truetype');
            font-weight: bold;
            font-style: normal;
        }

        @font-face {
            font-family: 'Abkai Iui';
            src: url('http://abkai.net/fonts/abkai-iui.eot');
            src: url('http://abkai.net/fonts/abkai-iui.eot?#iefix') format('embedded-opentype'),
            url('http://abkai.net/fonts/abkai-iui.woff2') format('woff2'),
            url('http://abkai.net/fonts/abkai-iui.woff') format('woff'),
            url('http://abkai.net/fonts/abkai-iui.ttf') format('truetype');
            font-weight: normal;
            font-style: normal;
        }

        @font-face {
            font-family: 'Mongolian Baiti';
            src: local("Mongolian Baiti"),
            url('http://abkai.net/fonts/monbaiti.ttf') format('truetype');
        }

        @font-face {
            font-family: 'Noto Sans Mongolian';
            src: url('http://abkai.net/fonts/notosansmongolian.eot');
            src: url('http://abkai.net/fonts/notosansmongolian.eot?#iefix') format('embedded-opentype'),
            url('http://abkai.net/fonts/notosansmongolian.woff2') format('woff2'),
            url('http://abkai.net/fonts/notosansmongolian.woff') format('woff'),
            url('http://abkai.net/fonts/notosansmongolian.ttf') format('truetype');
            font-weight: normal;
            font-style: normal;
        }

        /* RESET */
        html,body,div,span,applet,object,iframe,h1,h2,h3,h4,h5,h6,p,blockquote,pre,a,abbr,acronym,address,big,cite,code,del,dfn,em,font,img,ins,kbd,q,s,samp,small,strike,strong,sub,sup,tt,var,dl,dt,dd,ol,ul,li,fieldset,form,label,legend,table,caption,tbody,tfoot,thead,tr,th,td{border:0;outline:0;vertical-align:baseline;background:transparent;margin:0;padding:0;}

        /* BASIC */
        *:focus{outline:none;}
        .clear{clear:both;}
        body{background-color:#2C2C29;font-family: "Lucida Grande", "Lucida Sans Unicode", Helvetica, Arial, Verdana, "Hiragino Sans GB", "Microsoft YaHei", sans-serif;font-size:14px;}
        p{line-height:140%;padding:2px;margin:1px 0 15px;}
        a{color:#807D7A;}
        h2{background-color:#FFF;border-bottom:1px solid #DCDCDB;letter-spacing:-1px;font-size:24px;padding-bottom:3px;font-weight:400;margin:10px 0 3px 0;font-family: "Lucida Grande", "Lucida Sans Unicode", Helvetica, Arial, Verdana, "Hiragino Sans GB", "Microsoft YaHei", sans-serif;}
        h3#reply-title{background:transparent;border-bottom:1px solid #DCDCDB;letter-spacing:-1px;font-size:20px;padding-bottom:3px;font-weight:400;margin:10px 0 3px 0;font-family: "Lucida Grande", "Lucida Sans Unicode", Helvetica, Arial, Verdana, "Hiragino Sans GB", "Microsoft YaHei", sans-serif;}
        h2 a{font-weight:700;border:0;text-decoration:none;color:#2C2C29;display:block;}
        h3{font-size:1.8em;margin: 15px 0 15px;}
        h4{font-size:1.5em;margin: 15px 0 15px;}
        h5{font-size:1.4em;margin: 15px 0 15px;}
        h6{font-size:1.3em;margin: 15px 0 15px;}
        hr{color:#DCDCDB;background-color:#DCDCDB;height:1px;border:0px;}
        pre{width:100%; white-space:pre-wrap;}
        dl{padding:.4em 0 1em;}
        dt{text-decoration:underline;font-weight:bold;}
        dd{}

        /* LAYOUT */
        #wrapper{margin:0 auto;text-align:left;}
        h1#logo,h1#logo a{font-family: "Lucida Grande", "Lucida Sans Unicode", Helvetica, Arial, Verdana, "Hiragino Sans GB", "Microsoft YaHei", sans-serif; padding:0; margin-top:7px; font-size:36px;color:#FFF;text-decoration:none;text-transform:uppercase;}
        h1#logo small{color:#FFF;font-size:12px;display:block;margin:-2px 2px 1px;height:20px;}
        h1#logo small a{font-size:12px;border-bottom:1px solid #FFF;}
        #rss-feed{float:right;width:190px;font-weight:700;position:relative;left:7px;color:#FFF;text-decoration:none;}
        #header{height:113px;}
        #top{z-index:1;cursor:pointer;display:block;margin-left:5px;position:relative;bottom:-55px;margin-top:-55px;min-height:56px;}
        #top_cufon{cursor:pointer;display:block;margin-left:5px;position:relative;bottom:-55px;margin-top:-55px;min-height:56px;}
        #top_cufon small{ width:600px; }
        #top strong{display:none;}
        #top_bar{padding:72px 23px 0 20px;}
        #searchform{float:right;width:191px;height:26px;background:url(images/searchbox.png) no-repeat;position:relative;top:1px;}
        #header #s{border:1px solid #000;float:left;border:0;width:154px;background:none;color:#ACACAB;margin:4px 0 0 4px;}
        #header #go{float:right;width:25px;height:26px;background-color:transparent;border:0px;cursor:pointer;}
        #content{padding:15px 10px 15px 15px;margin:-7px 0 0 7px;z-index:20 !important;position:relative;}
        #content-body{display:inline-block;min-height:300px;height:auto !important;margin-right:25px;}
        * html #content-body{float:left;margin-right:24px;} *+html #content-body{float:left;margin-right:28px;}
        #footer{height:8px;}
        #footer .text{color:#8D837B;font-size:12px;display:block;padding:12px;}
        #footer .top{position:relative;right:5px;top:-5px;display:inline;float:right;}
        * html #footer .top{top:-20px;} *+html #footer .top{top:-20px;}
        #footer em, #footer em a{font-style:normal;color:#41413E;}

        /* FRONT MENU */

        ul#front_menu{float:left;position:relative;top:-4px;}
        * html .expand{margin-top:-13px;} *+html .expand{margin-top:-13px;}
        #front_menu li{list-style:none;float:left;margin-right:4px;}
        * html #front_menu li{height:36px;display:inline;}
        #front_menu li a{height:36px;display:block;background:url(images/nav.png) no-repeat left top;padding-left:15px;color:#2C2C29;font:550 .88em/26px Arial, Microdoft YaHei, Helvetica, sans-serif;text-decoration:none;cursor:pointer;}
        #front_menu li a span{height:36px;display:block;background:url(images/nav.png) no-repeat right top;line-height:36px;padding-right:15px;font-size:13px;font-family:  "Lucida Grande", "Lucida Sans Unicode", Helvetica, Arial, Verdana, "Hiragino Sans GB", "Microsoft YaHei", sans-serif;}
        #front_menu li a:hover,#front_menu li a.s{background-position:left bottom;}
        #front_menu li a:hover span,#front_menu li a.s span{background-position:right bottom;}
        * html #front_menu li a,* html #front_menu li a span{width:1%;white-space:nowrap;cursor:pointer;}
        * html #front_menu li a span{position:relative;}
        #front_menu li {background:none;float:left; position:relative;}
        #front_menu ul {width:200px;position:absolute;display:none; background:#FFF;border-left:1px solid #ACACAB;border-right:1px solid #ACACAB;border-bottom:1px solid #ACACAB;-moz-border-radius-bottomleft: 5px;-moz-border-radius-bottomright: 5px;-webkit-border-bottom-left-radius: 5px; -webkit-border-bottom-right-radius:5px;}
        #front_menu ul li a, #front_menu ul li a span{margin:-3px -1px;height:auto;background:none;}
        #front_menu li ul a {width:200px; float:left; white-space:nowrap;}
        #front_menu li ul a:hover{text-decoration:underline;}
        #front_menu ul ul {top:auto;}
        #front_menu li ul ul {left:1em; }
        #front_menu li:hover ul ul, #front_menu li:hover ul ul ul, #front_menu li:hover ul ul ul ul {display:none;}

        /* WP */
        blockquote{margin:20px 10px 10px 5px;border-left:4px solid #DDD;padding:0 5px 0 5px;text-align:justify;}
        .commenttext blockquote{border-left:4px solid #B6B6B5;}
        .wp-caption{border:1px solid #ddd;text-align:center;background-color:#f3f3f3;padding-top:4px;}
        .gallery-caption{ border:1px solid #ddd;text-align:center;background-color:#f3f3f3;padding-top:4px; }
        .wp-caption img{border:none;margin:0;padding:0;}
        .wp-caption p.wp-caption-text{font-size:11px;line-height:17px;color:#111;margin:0;padding:0 4px 5px;}
        .alignleft,img.alignleft{float:left;margin:5px 10px 5px 0;}
        .alignright,img.alignright{float:right;margin:5px 0 5px 10px;}
        .aligncenter,div.aligncenter,img.aligncenter{text-align:center;display:block;margin:10px auto;}
        abbr, acronym, span.abbr{cursor:help;border-bottom:1px dotted #000;}
        table{margin:.5em 0 1em;}
        table td,table th{text-align:left;border-right:1px solid #fff;padding:.9em .8em;}
        table th{background-color:#eee;text-transform:uppercase;font-weight:bold;border-bottom:1px solid #e8e1c8;}
        table td{background-color:#f5f5f5;}
        table th a{color:#d6f325;}
        table tr.even td{background-color:#eee;}
        table.nostyle td,table.nostyle th,table.nostyle tr.even td,table.nostyle tr:hover td{border:0;background:none;background-color:transparent;}
        .wp_syntax { width:auto; }
        .wp_syntax table { border:0 !important; }
        .wp_syntax table td { border:0 !important; }
        img.wp-smiley{border:0px;vertical-align:middle;}

        /* CONTENT */
        #content-body ul,#content-body ol{margin:15px 30px;font-size:13px;}
        #content-body ul li{list-style:circle;margin-bottom:4px;}
        .hentry{height:auto!important;margin-bottom:1em;}
        .sticky h2 a{color:red;}
        .comm_date{background:transparent url(images/date_comm_box.png) no-repeat;height:100px;width:57px;position:absolute;text-align:center;margin:0 0 0 -72px;z-index:2;}
        .only_date{background:transparent url(images/data_box.png) no-repeat !important;height:67px !important;}
        * html .comm_date{margin-top:10px;} *+html .comm_date{margin-top:10px;}
        .comm_date .data{margin-left:-1px;padding-top:8px;display:block;font-weight:700;text-transform:uppercase;font-size:12px;}
        .comm_date .nr_comm{padding-top:14px;color:#FFF;display:block;font-weight:700;}
        .comm_date .nr_comm_spot, .comm_date .dsq-comment-count{display:block;margin:-5px 9px 0 8px;padding:6px 0 5px 0;letter-spacing:-1px;font-size:12px;}
        .comm_date .data .j{font-size:30px;display:block;}
        .nr_comm a{color:#FFF;text-decoration:none;}
        .cat_tags{margin-top:10px;padding:8px 0 5px 10px;}
        .cat_tags_close{max-height:3px;height:3px;margin-bottom:20px;}
        * html .cat_tags_close{margin-top:-8px;}
        *:first-child+html .cat_tags{padding:9px 8px 0;margin-bottom:-3px;}
        .cat_tags .continue{float:right;padding-right:10px;width:100px;text-align:center;}
        .cat_tags .category{float:left;}
        .cat_tags a,.cat_tags .continue a{color:#2C2C29;}
        .cat_tags a:hover{color:#ACACAB;}


        /* SIDEBAR */
        .content-sidebar{width:191px;display:inline-block;overflow:hidden;vertical-align:top;}
        .content-sidebar input{padding:3px;border:1px solid #E5E2E0;margin-bottom:2px;}
        .content-sidebar h3{margin:8px 0 0 0 !important;display:block;background:#FFF url(images/sidebar_h3.png) no-repeat;height:22px;width:181px;font-weight:700;font-size:14px;padding:9px 0 0 10px;}
        .content-sidebar h3 a{text-decoration:none;color:#2C2C29;line-height:13px;}
        .content-sidebar ul{list-style:none;width:191px;padding:2px;}
        .content-sidebar li{list-style:none;}
        * html .content-sidebar ul{width:160px;}
        .content-sidebar ul li,.content-sidebar-2 ul li{display:block;color:#9D9793;line-height:16px;padding:4px 0 4px;border-bottom:1px solid #EEE;width:185px;}
        .content-sidebar ul ul li,.content-sidebar-2 ul ul li{border:0px;padding-bottom:0;width:140px;}
        .content-sidebar ul li.page_item ul li.page_item , .content-sidebar ul li.cat-item ul.children li.cat-item{background:url(images/arrow.gif) 0 11px no-repeat;padding-left:11px;margin-top:-3px;}
        .content-sidebar ul li.page_item ul li.page_item ul li.page_item, .content-sidebar ul li.cat-item ul.children li.cat-item ul.children li.cat-item{background:url(images/arrow.gif) 0 11px no-repeat;padding-left:12px;}
        .content-sidebar ul li a:hover,.content-sidebar .recentcomments a:hover{color:#AAA;}
        .content-sidebar .textwidget, .content-sidebar select{padding:3px;margin:10px 2px 10px 2px;width:188px;font-family: "Lucida Grande", "Lucida Sans Unicode", Helvetica, Arial, Verdana, "Hiragino Sans GB", "Microsoft YaHei", sans-serif;}
        .content-sidebar .recentcomments{display:block;border-bottom:1px solid #EEE;color:#9D9793;padding:4px 0px;line-height:16px;}
        .content-sidebar .right {float:right; width:91px;overflow:hidden;}
        .content-sidebar .left {float:left; width:91px;overflow:hidden;}

        /* COMMENTS */
        #content-body input{padding:3px;border:1px solid #E5E2E0;margin-bottom:2px;}
        #content-body textarea{border:1px solid #E5E2E0;width:97.5%;height:100px;padding:5px;font: 12px Verdana;}
        #content-body input#submit {width: 88px;height: 25px;border: 0px;background:#2C2C29 url(images/submit_btn.png) no-repeat;font: bold 12px Helvetica,Georgia,serif;color:#FFF;text-align:center;cursor:pointer;}
        #comentarii ol.commentlist{width:100%;margin:0;padding:0;font-size:12px;}
        ol.commentlist{list-style:none;}
        ol.commentlist li{list-style-type:none;margin-bottom: 10px;background-color: #F5F5F5;border: 1px solid #DDD;padding: 15px 10px 4px 10px;}
        ol.commentlist li ul{list-style-type: none;margin-left: 7px !important;}
        ol.commentlist li ul.children li{list-style:none !important;background-color: #FFF;width:100%;font-size:12px;}
        ol.commentlist li ul.children li ul.children li{background-color:#F5F5F5;}
        ol.commentlist li div.comment_content{float: left;width: 100%;}
        ol li div.comment_content div.commentmetadata{color: #999;border-bottom: 1px solid #ddd;margin:0px 8px 5px;}
        ol li div.comment_content div.commentmetadata a{color: #bbb;text-decoration: none;}
        ol li div.comment_content p{padding:0 0 16px 6px;}
        ol li div.comment_content .reply{margin:8px;}
        strong.comment_author{font-size:125%;}
        strong.comment_author a{text-decoration:underline !important;}
        a#cancel-comment-reply-link{text-transform:uppercase;font-size:80%;margin-left:10px;}
        li #respond{padding:7px;}
        li #respond h2, li #respond h3#reply-title{display:none;}
        li.comment-author-admin{border:1px solid #BBBBBB !important; }

        /* COMMENTS / TRACKBACKS TABS */
        #tabsContainer p{margin-bottom:-2px !important;}
        #tabsContainer{margin-top:2em;}
        #tabsContainer a{text-decoration:none;}
        .trackbacks{background-color:#EEEEEE;margin-bottom:5px;padding:10px;border-bottom:1px solid #CCC;}
        .tab-content {background-color:#FFF;display: none;}
        .tab-content p.no{padding-top:10px;}
        .tab-content.selected { display: block; }
        .clear_tab{clear:both;border-bottom:3px solid #2C2C29;margin-top:-21px;}
        .tabs {display: block;float: left;height: 30px;padding: 0 0 0 20px;line-height: 29px;position: relative;top: 1px;color: #787878;text-decoration: none;margin: 0 0px 0 0;}
        .subscribe_comments {display: block;float: right;height: 30px;padding: 0 0 0 20px;line-height: 29px;position: relative;top: 1px;color: #787878;text-decoration: none;margin: 0 5px 0 0;}
        .tabs span {display: block;float: left;padding: 0 20px 0 0;cursor:pointer;}
        .tabs.selected {background-color:#2C2C29;color:#FFF; }
        div.selected{background-color:#FFF;color:#2C2C29;}
        p.comment-form-author label, p.comment-form-author span.required,p.comment-form-email label, p.comment-form-email span.required,p.comment-form-url label{font-size:12px;margin-left:5px;}

        /* PAGINATION */
        .nav_link{margin-top:15px;border-top:1px solid #DDD;background-color:#F5F5F5;padding:10px;}
        .nav_link a{text-decoration:none;}
        .nav_link .page_number{border:1px solid #DDD;padding:2px 10px;background-color:#EDEDED;}
        .nav_link a .page_number{border:1px solid #DDD;background-color:#F5F5F5;padding:2px 10px;}
        .newer_older a{margin-top:1em;text-decoration:none;font-size:12px;letter-spacing:-1px;font-weight:700;}
        .newer a{background:#FFF url(images/older_newer.png) no-repeat;width:129px;padding:6px 3px 6px 0px;float:left;cursor:pointer;text-align:center;height:14px;}
        .older a{background:#FFF url(images/older_newer.png) no-repeat;width:129px;padding:6px 3px 6px 2px;float:right;cursor:pointer;text-align:center;height:14px;}
        .next_previous_links{margin-top:10px;border-top:1px solid #DDD;background-color:#F5F5F5;padding:0 5px;}
        .next_previous_links_comments{margin-top:10px;border-bottom:1px solid #DDD;background-color:#F5F5F5;padding:0 5px;}

        /* WIDGETS */
        #calendar_wrap{margin:0;}
        #wp-calendar {font-size: 1.2em;empty-cells: show;line-height:5px;margin-top:10px;}
        #wp-calendar a {font-size: 1.0em;display: block;font-weight: bold;}
        #wp-calendar #next a {padding-right: 10px;text-align: right;}
        #wp-calendar #prev a {padding-left: 10px;text-align: left;}
        #wp-calendar caption {width:98.8%;padding:10px 5px;margin:0;text-transform: uppercase;font-weight: lighter;font-size: .8em;color: #444;text-align: left;background:#C2C2C2;}
        #wp-calendar th {padding: 4px 5px 4px 5px;font-weight: 700;font-size: .8em;color: #666;text-align: center;background: #f4f4f4;}
        #wp-calendar td {padding: 6px 5px 6px 5px;text-align: center;}
        #wp-calendar td#today {background: #e0e0e0;}
        #wp-calendar td#prev a {padding: 0;text-align: left;font-weight: normal;}
        #wp-calendar td#next a {padding: 0;text-align: right;font-weight: normal;}
        a.rsswidget img{display:none;}
        div.rssSummary{margin:5px;}

        /* ARCHIVE */
        .archive_h2{text-transform:uppercase;cursor:pointer;font-size:16px;}
        .archive_h2 span{font-size:12px;}
        ul.hide{list-style-type:none;display:none;}

        /* OTHERS */
        .promote{border:1px solid #B6B6B5;padding:10px 10px 5px 10px;margin-top:1em;background:#EDEDED url(images/rss.png) 90% -35px no-repeat;}
        .promote h3{margin-left:3px; }
        .post-edit-link{display:block;background-color:#F5F5F5;margin-bottom:1em;padding:5px;color:#B6B6B5;}
        .post-edit-link:hover{background-color:#FFFFD3;color:#2C2C29;}
        .comment-edit-link{background-color:#EFEFEF;padding:1px 5px;color:#999999;border-left:1px solid #DDD;}
        .about_author{background-color:#F5F5F5;padding:1px 10px;}
        .bypostauthor{ background-color:#F5F5F5; }
        .about_author h4{ font-size:12px;padding-top:3px; }
        .moderation{font-size:80%;}
        #breadcrumbs{background-color:#F5F5F5;padding:5px;}
        ol.snap_nav{list-style:none;display:block;}
        ol.snap_nav li{display:inline; background-color:#F4F4F4;padding:3px;}
        ol.snap_nav .snap_selected{background-color:#DDD;}
        .simple_date{background:url(images/date.png) 5px 50% no-repeat;padding:8px 25px;background-color:#EEE;margin-bottom:1em;}

        /* by Mac */
        .vert-lr {writing-mode: vertical-lr; -webkit-writing-mode: vertical-lr; -o-writing-mode: vertical-lr; -ms-writing-mode: tb-lr; writing-mode: tb-lr;}
        .vert-rl {writing-mode: tb-rl; -webkit-transform: rotate(90deg) translate(0, -100%); -webkit-transform-origin: 0% 0%; -moz-transform: rotate(90deg) translate(0,-100%); -moz-transform-origin: 0% 0%; -o-transform: rotate(90deg) translate(0,-100%); -o-transform-origin: 0% 0%; white-space: nowrap;}
        .vert {writing-mode: vertical-rl; -webkit-writing-mode: vertical-rl; -o-writing-mode: vertical-rl; -ms-writing-mode: tb-rl; writing-mode: tb-rl;}

        .kaiti {font-family: kaiti, 楷体, simkai, simkai_gb2312, kaiti_gb2312, 楷体_GB2312, STKaiti, 华文楷体;}
        .xanyan {font-family: "Abkai Xanyan", 太清白体;}
        .iui {font-family: "Abkai Iui", "Abkai Iui X0", "太清水晶 X0"; font-size:150%;}
    </style>
    <script>
        /*
    Unicode Phonetic Parser for writing in webpages
    This script transliterate the user input and display unicode characters

    Name: Ekushey Unicode Parser
    Version: 1.0.0.6
    Date Created: 30th July, 2006
    Author: Hasin Hayder (http://hasin.wordpress.com/)
    Modified by: Mac Ma (http://abkai.net/)
    License: LGPL
    */

        /**
         * This script is released under Lesser GNU Public License [LGPL]
         * which implies that you are free to use this script in your
         * web applications without any problem. No warranty ensured. If you like
         * this script, Please acknowledge by keeping a link to my website
         * http://hasin.wordpress.com in the page where you use this script.
         */
        /**
         * Last Modification:01/11/2008 by Sabuj Kundu (http://manchu.wordpress.com)
         */
        /**
         * Added Intellisense (27 Jan, 2008 by Hasin Hayder)
         */
        /**
         * Little modification by Sabuj Kundu to solve the dhirgho i kar and dhirgho u kar :P
         */
        /**
         *Modified to output Manchu/Sibe/Daur by Hoolulu (Baturu, http://www.daicing.com/)
         */
        /**
         *Modified again to output Manchu by Mac Ma (aka Hoolulu/Baturu) (http://abkai.net/) (Sept 17, 2015)
         */

// Set of Characters
        var activeta; //active text area
        var phonetic=new Array();
        var shift=false; //for intelligent shift

        // Letters
        phonetic['a']='\u1820';  // Spe
        phonetic['e']='\u185D';  // Spe
        phonetic['i']='\u1873';  // -
        phonetic['o']='\u1823';  // Spe
        phonetic['u']='\u1860';
        phonetic['v']='\u1861';
        phonetic['U']=phonetic['u'];  // Caps
        phonetic['V']=phonetic['v'];  // Caps

        phonetic['b']='\u182A';  // -
        phonetic['p']='\u1866';
        phonetic['m']='\u182E';  // Ctrl
        phonetic['f']='\u1876';  // Ctrl
        phonetic['P']=phonetic['p'];  // Caps

        phonetic['d']='\u1869';  // -
        phonetic['t']='\u1868';
        phonetic['n']='\u1828';  // -
        phonetic['l']='\u182F';
        phonetic['T']=phonetic['t'];  // Caps
        phonetic['L']=phonetic['l'];  // Caps

        phonetic['g']='\u1864';
        phonetic['G']='\u186C';
        phonetic['gg']=phonetic['G'];
        phonetic['k']='\u1874';
        phonetic['K']='\u183A';
        phonetic['kk']=phonetic['K'];
        phonetic['h']='\u1865';
        phonetic['H']='\u186D';
        phonetic['hh']=phonetic['H'];

        phonetic['j']='\u1835';
        phonetic['q']='\u1834';  // -
        phonetic['x']='\u1867';
        phonetic['J']=phonetic['j'];  // Caps
        phonetic['X']=phonetic['x'];  // Caps

        phonetic['z']='\u186F';
        phonetic['c']='\u186E';
        phonetic['s']='\u1830';
        phonetic['Z']=phonetic['z'];  // Caps
        phonetic['C']=phonetic['c'];  // Caps
        phonetic['S']=phonetic['s'];  // Caps

        phonetic['y']='\u1836';
        phonetic['Y']='\u185F';
        phonetic['w']='\u1838';  // Ctrl

        phonetic['r']='\u1875';
        phonetic['R']='\u1870';
        phonetic['rr']=phonetic['R'];

        phonetic[';']='\u1829';  // -
        phonetic['ng']=phonetic[';'];


        // Spe
        phonetic['A']='\u1807';
        phonetic['E']='\u180A';
        phonetic['O']='\u25CC';

        phonetic['aO']=phonetic['a'];
        phonetic['bO']=phonetic['b'];
        phonetic['cO']=phonetic['c'];
        phonetic['dO']=phonetic['d'];
        phonetic['eO']=phonetic['e'];
        phonetic['fO']=phonetic['f'];
        phonetic['gO']=phonetic['g'];

        phonetic['hO']=phonetic['h'];
        phonetic['iO']=phonetic['i'];
        phonetic['jO']=phonetic['j'];
        phonetic['kO']=phonetic['k'];
        phonetic['lO']=phonetic['l'];
        phonetic['mO']=phonetic['m'];
        phonetic['nO']=phonetic['n'];

        phonetic['oO']=phonetic['o'];
        phonetic['pO']=phonetic['p'];
        phonetic['qO']=phonetic['q'];
        phonetic['rO']=phonetic['r'];
        phonetic['sO']=phonetic['s'];
        phonetic['tO']=phonetic['t'];

        phonetic['uO']=phonetic['u'];
        phonetic['vO']=phonetic['v'];
        phonetic['wO']=phonetic['w'];
        phonetic['xO']=phonetic['x'];
        phonetic['yO']=phonetic['y'];
        phonetic['zO']=phonetic['z'];

        phonetic[',O']=phonetic[','];
        phonetic['.O']=phonetic['.'];

        phonetic['AO']=phonetic['A'];
        phonetic['BO']=phonetic['B'];
        phonetic['CO']=phonetic['C'];
        phonetic['DO']=phonetic['D'];
        phonetic['EO']=phonetic['E'];
        phonetic['FO']=phonetic['F'];
        phonetic['GO']=phonetic['G'];

        phonetic['HO']=phonetic['H'];
        phonetic['IO']=phonetic['I'];
        phonetic['JO']=phonetic['J'];
        phonetic['KO']=phonetic['K'];
        phonetic['LO']=phonetic['L'];
        phonetic['MO']=phonetic['M'];
        phonetic['NO']=phonetic['N'];

        phonetic['OO']=phonetic['O'];
        phonetic['PO']=phonetic['P'];
        phonetic['QO']=phonetic['Q'];
        phonetic['RO']=phonetic['R'];
        phonetic['SO']=phonetic['S'];
        phonetic['TO']=phonetic['T'];

        phonetic['UO']=phonetic['U'];
        phonetic['VO']=phonetic['V'];
        phonetic['WO']=phonetic['W'];
        phonetic['XO']=phonetic['X'];
        phonetic['YO']=phonetic['Y'];
        phonetic['ZO']=phonetic['Z'];

        phonetic['ggO']=phonetic['G'];
        phonetic['kkO']=phonetic['K'];
        phonetic['hhO']=phonetic['H'];
        phonetic['rrO']=phonetic['R'];
        phonetic['ngO']=phonetic[';'];


        // - etc.
        phonetic['I']='\u202F'+ phonetic['i'];
        phonetic['N']='\u202F'+ phonetic['n']+ phonetic['i'];
        phonetic['Q']='\u202F'+ phonetic['q']+ phonetic['i'];
        phonetic['B']='\u202F'+ phonetic['b']+ phonetic['e'];
        phonetic['D']='\u202F'+ phonetic['d']+ phonetic['e'];
        phonetic['DR']='\u202F'+ phonetic['d']+ phonetic['e']+ phonetic['r']+ phonetic['i'];

        phonetic['iii']=phonetic['I'];
        phonetic['nnn']=phonetic['N'];
        phonetic['qqq']=phonetic['Q'];
        phonetic['bbb']=phonetic['B'];
        phonetic['ddd']=phonetic['D'];

        phonetic['Dr']=phonetic['DR'];
        phonetic[':']=phonetic['N'];

        phonetic['ii']=phonetic['i']+ phonetic['i'];
        phonetic['nn']=phonetic['n']+ '\u180B';  // nF
        phonetic['qq']=phonetic['q']+ phonetic['q'];
        phonetic['bb']=phonetic['b']+ phonetic['b'];
        phonetic['dd']=phonetic['d']+ phonetic['d'];

        phonetic['yy']=phonetic['I'];

        // Daur -d
        phonetic['DA']='\u202F'+ '\u200D'+ phonetic['d']+ phonetic['a'];
        phonetic['DE']='\u202F'+ '\u200D'+ phonetic['d']+ phonetic['e'];
        phonetic['DO']='\u202F'+ '\u200D'+ phonetic['d']+ phonetic['o'];
        phonetic['DU']='\u202F'+ '\u200D'+ phonetic['d']+ phonetic['u'];

        phonetic['Da']=phonetic['DA'];
        phonetic['De']=phonetic['DE'];
        phonetic['Do']=phonetic['DO'];
        phonetic['Du']=phonetic['DU'];

        phonetic['ddda']=phonetic['DA'];
        phonetic['ddde']=phonetic['DE'];
        phonetic['dddo']=phonetic['DO'];
        phonetic['dddu']=phonetic['DU'];


        // jy qy xy rry zy cy sy
        phonetic['jy']='\u1877'+ phonetic['i'];
        phonetic['jY']=phonetic['jy'];
        phonetic['Jy']=phonetic['jy'];
        phonetic['JY']=phonetic['jy'];
        phonetic['Ji']=phonetic['jy'];

        phonetic['qy']='\u1871'+ phonetic['i'];
        phonetic['qY']=phonetic['qy'];
        phonetic['Qy']=phonetic['qy'];
        phonetic['QY']=phonetic['qy'];
        phonetic['Qi']=phonetic['qy'];

        phonetic['xy']=phonetic['x']+ phonetic['i'];
        phonetic['xY']=phonetic['xy'];
        phonetic['Xy']=phonetic['xy'];
        phonetic['XY']=phonetic['xy'];

        phonetic['rry']=phonetic['R']+ phonetic['i'];
        phonetic['rrY']=phonetic['rry'];
        phonetic['Ry']=phonetic['rry'];
        phonetic['RY']=phonetic['rry'];

        phonetic['zy']=phonetic['z']+ phonetic['i'];
        phonetic['zY']=phonetic['zy'];
        phonetic['Zy']=phonetic['zy'];
        phonetic['ZY']=phonetic['zy'];

        phonetic['cy']=phonetic['c']+ phonetic['Y'];
        phonetic['Cy']=phonetic['cy'];

        phonetic['sy']=phonetic['s']+ phonetic['Y'];
        phonetic['Sy']=phonetic['sy'];

        phonetic['sya']=phonetic['s']+ phonetic['y']+ phonetic['a'];
        phonetic['sye']=phonetic['s']+ phonetic['y']+ phonetic['e'];
        phonetic['syi']=phonetic['s']+ phonetic['y']+ phonetic['i'];
        phonetic['syo']=phonetic['s']+ phonetic['y']+ phonetic['o'];
        phonetic['syu']=phonetic['s']+ phonetic['y']+ phonetic['u'];
        phonetic['syv']=phonetic['s']+ phonetic['y']+ phonetic['v'];

        phonetic['Sya']=phonetic['sya'];
        phonetic['Sye']=phonetic['sye'];
        phonetic['Syi']=phonetic['syi'];
        phonetic['Syo']=phonetic['syo'];
        phonetic['Syu']=phonetic['syu'];
        phonetic['Syv']=phonetic['syv'];

        phonetic['syao']=phonetic['sya']+ phonetic['u'];
        phonetic['syeo']=phonetic['sye']+ phonetic['u'];
        phonetic['syio']=phonetic['syi']+ phonetic['u'];
        phonetic['syoo']=phonetic['syo']+ phonetic['u'];
        phonetic['syuo']=phonetic['syu']+ phonetic['u'];
        phonetic['syvo']=phonetic['syv']+ phonetic['u'];

        phonetic['Syao']=phonetic['syao'];
        phonetic['Syeo']=phonetic['syeo'];
        phonetic['Syio']=phonetic['syio'];
        phonetic['Syoo']=phonetic['syoo'];
        phonetic['Syuo']=phonetic['syuo'];
        phonetic['Syvo']=phonetic['syvo'];


        // -o ng
        phonetic['ao']=phonetic['a']+ phonetic['u'];
        phonetic['eo']=phonetic['e']+ phonetic['u'];
        phonetic['io']=phonetic['i']+ phonetic['u'];
        phonetic['oo']=phonetic['o']+ phonetic['u'];
        phonetic['uo']=phonetic['u']+ phonetic['u'];
        phonetic['vo']=phonetic['v']+ phonetic['u'];

        phonetic['nga']=phonetic['n']+ phonetic['g']+ phonetic['a'];
        phonetic['nge']=phonetic['n']+ phonetic['g']+ phonetic['e'];
        phonetic['ngi']=phonetic['n']+ phonetic['g']+ phonetic['i'];
        phonetic['ngo']=phonetic['n']+ phonetic['g']+ phonetic['o'];
        phonetic['ngu']=phonetic['n']+ phonetic['g']+ phonetic['u'];
        phonetic['ngv']=phonetic['n']+ phonetic['g']+ phonetic['v'];

        phonetic['ngao']=phonetic['nga']+ phonetic['u'];
        phonetic['ngeo']=phonetic['nge']+ phonetic['u'];
        phonetic['ngio']=phonetic['ngi']+ phonetic['u'];
        phonetic['ngoo']=phonetic['ngo']+ phonetic['u'];
        phonetic['nguo']=phonetic['ngu']+ phonetic['u'];
        phonetic['ngvo']=phonetic['ngv']+ phonetic['u'];


        // Punc
        phonetic[',']='\u1808';
        phonetic[',,']='\u1804';
        phonetic[',,,']=',';
        phonetic['.']='\u1809';
        phonetic['..']='\u1801';
        phonetic['...']='.';

        phonetic['$']='¥';
        phonetic['$$']='$';
        phonetic['^']='※';
        phonetic['^^']='^';

        phonetic['-']='-';
        phonetic['--']='\u2013';
        phonetic['---']='\u2014';

        phonetic['[']='「';
        phonetic['[[']='[';
        phonetic['{']='『';
        phonetic['@{{']='{';// laravel 转义 输出

        phonetic[']']='」';
        phonetic[']]']=']';
        phonetic['}']='』';
        phonetic['}}']='}';

        phonetic["'"]='「';
        phonetic["''"]="'";
        phonetic['"']='『';
        phonetic['""']='"';

        phonetic['\u005C']='」';
        phonetic['\u005C\u005C']='\u005C';
        phonetic['|']='』';
        phonetic['||']='|';

        phonetic['`']='·';
        phonetic['``']='`';


        // F1 - F10
        phonetic['F']='\u180B';
        phonetic['FF']='\u180C';
        phonetic['FFF']='\u180D';
        phonetic['FFFF']='\u180E';

        phonetic['W']='\u200D';
        phonetic['M']='\u202F';

        phonetic['F1']='\u180B';
        phonetic['F2']='\u180C';
        phonetic['F3']='\u180D';
        phonetic['F4']='\u180E';

        phonetic['F5']='\u200D';
        phonetic['F6']='\u200C';
        phonetic['F7']='\u2060';
        phonetic['F8']='\u202F';

        phonetic['F9']='\u00A0';
        phonetic['F0']='\u3000';


        // kgh-'v
        phonetic['kkv']=phonetic['k']+ '\u180B'+ phonetic['v'];
        phonetic['ggv']=phonetic['g']+ '\u180B'+ phonetic['v'];
        phonetic['hhv']=phonetic['h']+ '\u180B'+ phonetic['v'];

        phonetic['Kv']=phonetic['kkv'];
        phonetic['Gv']=phonetic['ggv'];
        phonetic['Hv']=phonetic['hhv'];

        phonetic['kvF']=phonetic['kkv'];
        phonetic['gvF']=phonetic['ggv'];
        phonetic['hvF']=phonetic['hhv'];

        phonetic['kvv']=phonetic['kkv'];
        phonetic['gvv']=phonetic['ggv'];
        phonetic['hvv']=phonetic['hhv'];


        phonetic['kv']=phonetic['k']+ phonetic['v'];
        phonetic['gv']=phonetic['g']+ phonetic['v'];
        phonetic['hv']=phonetic['h']+ phonetic['v'];

        phonetic['kvo']=phonetic['kv']+ phonetic['u'];
        phonetic['gvo']=phonetic['gv']+ phonetic['u'];
        phonetic['hvo']=phonetic['hv']+ phonetic['u'];

        phonetic['kvvo']=phonetic['kkv']+ phonetic['u'];
        phonetic['gvvo']=phonetic['ggv']+ phonetic['u'];
        phonetic['hvvo']=phonetic['hhv']+ phonetic['u'];

        //End Set

        var carry = '';  //This variable stores each keystrokes
        var old_len =0; //This stores length parsed bangla charcter
        var ctrlPressed=false;
        var len_to_process_oi_kar=0;
        var first_letter = false;
        var carry2="";
        isIE=document.all? 1:0;
        var switched=false;

        function checkKeyDown(ev)
        {
            //just track the control key
            var e = (window.event) ? event.keyCode : ev.which;
            if (e=='17')
            {
                ctrlPressed = true;
            }
            else if(e==16)
                shift=true;
        }

        function checkKeyUp(ev)
        {
            //just track the control key
            var e = (window.event) ? event.keyCode : ev.which;
            if (e=='17')
            {
                ctrlPressed = false;
                //alert(ctrlPressed);
            }

        }



        function parsePhonetic(evnt)
        {
            // main phonetic parser
            var t = document.getElementById(activeta); // the active text area
            var e = (window.event) ? event.keyCode : evnt.which; // get the keycode

            if (e=='113')
            {
                //switch the keyboard mode
                if(ctrlPressed){
                    switched = !switched;
                    //alert("H"+switched);
                    return true;
                }
            }

            if (switched) return true;

            if(ctrlPressed)
            {
                // user is pressing control, so leave the parsing
                e=0;
            }

            if (shift)
            {
                var char_e = String.fromCharCode(e).toUpperCase(); // get the character equivalent to this keycode
                shift=false;
            }
            else
                var char_e = String.fromCharCode(e); // get the character equivalent to this keycode

            if(e==8 || e==32)
            {
                // if space is pressed we have to clear the carry. otherwise there will be some malformed conjunctions
                carry = " ";
                old_len = 1;
                return;
            }

            lastcarry = carry;
            carry += "" + char_e;	 //append the current character pressed to the carry

            /*	//the intellisense
                if ((phonetic['vowels'].indexOf(lastcarry)!=-1 && phonetic['vowels'].indexOf(char_e)!=-1) || (lastcarry==" " && phonetic['vowels'].indexOf(char_e)!=-1) )
                {
                    //let's check for dhirgho i kar and dhirgho u kar :P
                    if(carry=='ii' || carry=='uu'){carry = lastcarry+char_e;}
                    else
                    {
                        char_e = char_e.toUpperCase();
                        carry = lastcarry+char_e;
                    }
                }
                //intellisense ended
            */

            bangla = parsePhoneticCarry(carry); // get the combined equivalent
            tempBangla = parsePhoneticCarry(char_e); // get the single equivalent

            if (tempBangla == ".." || bangla == "..") //that means it has next sibling
            {
                return false;
            }
            //alert(carry);

            /*
                if (char_e=="+" || char_e=="="||char_e=="`")
                {
                    if(carry=="++" || carry=="=="||carry=="``")
                    {
                        // check if it is a plus/equal/accent  key/sign
                        insertConjunction(char_e,old_len);
                        old_len=1;
                        return false;
                    }
                    //otherwise this is a simple joiner
                    insertAtCursor("\u09CD");old_len = 1;
                    carry2=carry;
                    carry=char_e;
                    return false;
                }
            */



            else if(old_len==0) //first character
            {
                // this is first time someone press a character
                insertConjunction(bangla,1);
                old_len=1;
                return false;

            }

            /*	else if((char_e=='z' || char_e=='Z')&& carry2=="r+")//force Za-phola after Ra
                {
                    //alert('yes');
                    insertConjunction('\u200D'+'\u09CD'+phonetic['z'],1);
                    old_len=1;
                    return false;
                } */

            /*	else if(carry=="Ao")
                {
                    // its a shore o
                    insertConjunction(parsePhoneticCarry("ao"),old_len);
                    old_len=1;
                    return false;
                }
                else if (carry == "ii")
                {
                    // process dirgho i kar
                    //alert('dirgho i kar');
                    insertConjunction(phonetic['ii'],1);
                    old_len = 1;
                    return false;
                }

                else if (carry == "oI")
                {
                    //oi kar
                    insertConjunction('\u09C8',old_len); //same treatment like ou kar (By manchu)
                    old_len = 1;
                    return false;
                }

                else if (char_e == "o")
                {
                    old_len = 1;
                    insertAtCursor('\u09CB');
                    carry = "o";
                    return false;
                }


                else if (carry == "oU")
                {
                    // ou kar
                    insertConjunction("\u09CC",old_len);
                    old_len = 1;
                    return false;
                }
                */

            else if((bangla == "" && tempBangla !="")) //that means it has no joint equivalent
            {

                // there is no joint equivalent - so show the single equivalent.
                bangla = tempBangla;
                if (bangla=="")
                {
                    // there is no available equivalent - leave as is
                    carry ="";
                    return;
                }

                else
                {
                    // found one equivalent
                    carry = char_e;
                    insertAtCursor(bangla);
                    old_len = bangla.length;
                    return false;
                }
            }
            else if(bangla!="")//joint equivalent found
            {
                // we have found some joint equivalent process it

                insertConjunction(bangla, old_len);
                old_len = bangla.length;
                return false;
            }
        }


        function parsePhoneticCarry(code)
        {
            //this function just returns a bangla equivalent for a given keystroke
            //or a conjunction
            //just read the array - if found then return the bangla eq.
            //otherwise return a null value
            if (!phonetic[code])  //Oh my god :-( no bangla equivalent for this keystroke

            {
                return ''; //return a null value
            }
            else
            {
                return ( phonetic[code]);  //voila - we've found bangla equivalent
            }

        }


        function insertAtCursor(myValue) {
            /**
             * this function inserts a character at the current cursor position in a text area
             * many thanks to alex king and phpMyAdmin for this cool function
             *
             * This function is originally found in phpMyAdmin package and modified by Hasin Hayder to meet the requirement
             */
            var myField = document.getElementById(activeta);
            if (document.selection) {
                myField.focus();
                sel = document.selection.createRange();
                sel.text = myValue;
                sel.collapse(true);
                sel.select();
            }
            //MOZILLA/NETSCAPE support
            else if (myField.selectionStart || myField.selectionStart == 0) {

                var startPos = myField.selectionStart;
                var endPos = myField.selectionEnd;
                var scrollTop = myField.scrollTop;
                startPos = (startPos == -1 ? myField.value.length : startPos );
                myField.value = myField.value.substring(0, startPos)
                    + myValue
                    + myField.value.substring(endPos, myField.value.length);
                myField.focus();
                myField.selectionStart = startPos + myValue.length;
                myField.selectionEnd = startPos + myValue.length;
                myField.scrollTop = scrollTop;
            } else {
                var scrollTop = myField.scrollTop;
                myField.value += myValue;
                myField.focus();
                myField.scrollTop = scrollTop;
            }
        }

        function insertConjunction(myValue, len) {
            /**
             * this function inserts a conjunction and removes previous single character at the current cursor position in a text area
             *
             * This function is derived from the original one found in phpMyAdmin package and modified by Hasin to meet our need
             */
                //alert(len);
            var myField = document.getElementById(activeta);
            if (document.selection) {
                myField.focus();
                sel = document.selection.createRange();
                if (myField.value.length >= len){  // here is that first conjunction bug in IE, if you use the > operator
                    sel.moveStart('character', -1*(len));
                    //sel.moveEnd('character',-1*(len-1));
                }
                sel.text = myValue;
                sel.collapse(true);
                sel.select();
            }
            //MOZILLA/NETSCAPE support
            else if (myField.selectionStart || myField.selectionStart == 0) {
                myField.focus();
                var startPos = myField.selectionStart-len;
                var endPos = myField.selectionEnd;
                var scrollTop = myField.scrollTop;
                startPos = (startPos == -1 ? myField.value.length : startPos );
                myField.value = myField.value.substring(0, startPos)
                    + myValue
                    + myField.value.substring(endPos, myField.value.length);
                myField.focus();
                myField.selectionStart = startPos + myValue.length;
                myField.selectionEnd = startPos + myValue.length;
                myField.scrollTop = scrollTop;
            } else {
                var scrollTop = myField.scrollTop;
                myField.value += myValue;
                myField.focus();
                myField.scrollTop = scrollTop;
            }
            //document.getElementById("len").innerHTML = len;
        }

        function makePhoneticEditor(textAreaId)
        {
            activeTextAreaInstance = document.getElementById(textAreaId);
            activeTextAreaInstance.onkeypress = parsePhonetic;
            activeTextAreaInstance.onkeydown = checkKeyDown;
            activeTextAreaInstance.onkeyup = checkKeyUp;
            activeTextAreaInstance.onfocus = function(){activeta=textAreaId;};
        }
        function makeVirtualEditor(textAreaId)
        {
            activeTextAreaInstance = document.getElementById(textAreaId);
            activeTextAreaInstance.onfocus = function(){activeta=textAreaId;};
        }
    </script>
</head>
<body class="container">
<div class="su-tabs su-tabs-style-default" data-active="1">
   <h1> <a href="/home">满族空间--在线输入法</a></h1>
    <div class="su-tabs-nav" id="tab_nav">
        <span class="" data-url="tab1" data-target="blank">标准模式（竖排从左到右　↓→↓）</span>
        <span class="su-tabs-current" data-url="tab2" data-target="blank">兼容模式（竖排从右到左　↓←↓）</span>
        <span class="" data-url="tab3" data-target="blank">※ 浏览器兼容列表 ※</span></div><div class="su-tabs-panes">
        <div class="su-tabs-pane su-clearfix" id="tab1" style="display: none;">
            <form><textarea class="vert-lr xanyan" name="manjus" id="manjus" style="font-family: Abkai Xanyan, 太清白体; font-size: 36px; width: 670px; height: 400px;" cols="80" rows="10" onfocus=""></textarea>
                <p></p>
                <p><input type="button" onclick="switched=!switched;" value="切换输入状态">　　　　<strong>太清在线输入法：满文</strong>　（<span style="color: red;">请将键盘输入法设置于拉丁字母/英文输入状态</span>）</p>
            </form>
            <p><script>makePhoneticEditor('manjus');
                </script></p>
        </div>
        <div class="su-tabs-pane su-clearfix" id="tab2" style="display: block;">
            <form><textarea class="vert-rl xanyan" name="manjuc" id="manjuc" style="font-family: Abkai Xanyan, 太清白体; font-size: 36px; width: 670px; height: 670px;" cols="80" rows="10" onfocus=""></textarea>
                <p></p>
                <p><input type="button" onclick="switched=!switched;" value="切换输入状态">　　　　<strong>太清在线输入法：满文</strong>　（<span style="color: red;">请将键盘输入法设置于拉丁字母/英文输入状态</span>）</p>
            </form>
            <p><script>makePhoneticEditor('manjuc');
                </script></p>
        </div>
        <div class="su-tabs-pane su-clearfix" id="tab3" style="display: none;">
            <em>Windows</em><br>
            【标准模式】Edge、IE、<a href="http://abkai.net/core/zh/read-me-first/configure-applications/" target="_blank">Firefox（火狐）</a>、Safari、双核浏览器 <span style="font-size:85%;">兼容模式·IE内核</span><br>
            【兼容模式】Chrome、Opera、遨游云浏览器、双核浏览器 <span style="font-size:85%;">急速模式·Chromium内核</span><p></p>
            <p>※※ <strong>双核浏览器</strong>：QQ浏览器、360浏览器、搜狗浏览器、2345浏览器、UC浏览器……</p>
            <p><em>Linux</em><br>
                【标准模式】<a href="http://abkai.net/core/zh/read-me-first/configure-applications/" target="_blank">Firefox（火狐）</a><br>
                【兼容模式】Chromium、Epiphany、Arora、QupZilla</p>
            <p><em>Android</em><br>
                【标准模式】<a href="http://abkai.net/core/zh/read-me-first/configure-applications/" target="_blank">Firefox（火狐）</a><br>
                【兼容模式】小米浏览器</p>
            <p><em>Mac OS X 10.10</em><br>
                【标准模式】<a href="http://abkai.net/core/zh/read-me-first/configure-applications/" target="_blank">Firefox（火狐）</a><br>
                【兼容模式】Chrome</p>
            <p><em>iOS 9</em><br>
                【兼容模式】Safari、Chrome、Opera、Dolphin、Bing、Maxthon</p>
            <p><em>其他系统</em><br>
                PlayStation 4</p>
            <hr>
            ※ <strong>支持标准模式</strong>：可完美使用标准模式，即满文显示、连接、变形正常，排版为<strong>竖排从左到右</strong>。通常支持标准模式的浏览器都支持兼容模式。支持标准模式的浏览器只列入支持标准模式列表，不列入支持兼容模式列表。<br>
            ※ <strong>支持兼容模式</strong>：如果标准模式下，满文显示正常，但是排版为<strong>横排从左到右</strong>，即为不支持标准模式。通常此种情况都支持兼容模式，即满文显示、连接、变形正常，排版为<strong>竖排从右到左</strong>。<br>
            ※ <strong>不支持</strong>：包括满文连接异常、变形异常、不显示满文、拉丁字母不能正常转化为满文字母等情况。<br>
        </div>


        <p style="text-align: center;">【说明】</p>
        <p>使用本在线输入法可在键盘输入法处于拉丁字母/英文输入状态下（如英文输入法、中文输入法的英文状态），直接在浏览器中输出满文，兼容 Windows、Linux、Android、Mac OS X、iOS 平台。满文采用 Unicode 编码，排版为标准的满文方式（竖排从左到右）。本输入法使用在线太清满文字体，客户端无需安装字体。点击 <strong>切换输入状态</strong> 可在满文输入和拉丁字母输入两种状态间切换。本输入法亦具有快捷输入和智能识别功能。</p>
        <p><strong>版本</strong>：15.09a【<strong>更新</strong>：<span class="su-tooltip" data-close="no" data-behavior="hover" data-my="top center" data-at="bottom center" data-classes="su-qtip qtip-plain su-qtip-size-default qtip-shadow" data-title="" data-hasqtip="0" oldtitle="改进在 Android 系统上的兼容性" title=""><span style="text-decoration: underline; color: #808080;">15.09a</span></span>··<span class="su-tooltip" data-close="no" data-behavior="hover" data-my="top center" data-at="bottom center" data-classes="su-qtip qtip-plain su-qtip-size-default qtip-shadow" data-title="" data-hasqtip="1" oldtitle="重大改版" title=""><span style="text-decoration: underline; color: #808080;">15.09</span></span>····<span class="su-tooltip" data-close="no" data-behavior="hover" data-my="top center" data-at="bottom center" data-classes="su-qtip qtip-plain su-qtip-size-default qtip-shadow" data-title="" data-hasqtip="2" oldtitle="公开发布" title=""><span style="text-decoration: underline; color: #808080;">08.09</span></span>】</p>
        <p>※※ 中点（·）表示音节界限。<br>
            ※※ <span style="color:red;">红色表示暂不适用于安卓。</span></p>
        <p>1. <strong>基本键位</strong>：键位安排基于太清转写，转写带撇号的字母使用双字母或上档（即 Shift 组合键）。</p>
        <p>　　【<span class="iui">ᠠ</span> a】a　【<span class="iui">ᡝ</span> e】e　【<span class="iui">ᡳ</span> i】i　【<span class="iui">ᠣ</span> o】o　【<span class="iui">ᡠ</span> u】u　【<span class="iui">ᡡ</span> v】v<br>
            　　【<span class="iui">ᠪ</span> b】b　【<span class="iui">ᡦ</span> p】p　【<span class="iui">ᠮ</span> m】m　【<span class="iui">ᡶ</span> f】f<br>
            　　【<span class="iui">ᡩ</span> d】d　【<span class="iui">ᡨ</span> t】t　【<span class="iui">ᠨ</span> n】n　【<span class="iui">ᠯ</span> l】l<br>
            　　【<span class="iui">ᡤ</span> g】g　【<span class="iui">ᡴ</span> k】k　【<span class="iui">ᡥ</span> h】h　【<span class="iui">ᠩ</span> ng】ng、分号<br>
            　　【<span class="iui">ᡬ</span> gʼ】gg、G　【<span class="iui">ᠺ</span> kʼ】kk、K　【<span class="iui">ᡭ</span> hʼ】hh、H<br>
            　　【<span class="iui">ᠵ</span> j】j　【<span class="iui">ᠴ</span> q】q　【<span class="iui">ᡧ</span> x】x　【<span class="iui">ᡰ</span> rʼ】rr、R<br>
            　　【<span class="iui">ᡯ</span> z】z　【<span class="iui">ᡮ</span> c】c　【<span class="iui">ᠰ</span> s】s　【<span class="iui">ᡵ</span> r】r<br>
            　　【<span class="iui">ᠶ</span> y】y　【<span class="iui">ᠸ</span> w】w</p>
        <p>※ 对比：【n·g】<span style="color:red;">ng</span>、nOg　【n·gʼ】nG、nOgg　【ng】ng、分号<br>
            ※ <span style="color:red;">输入 ng 将被智能识别为 <span class="iui">ᠩ</span> ng 或 <span class="iui">ᠨᡤ</span> n·g。</span><br>
            ※ 输入 ngg 将仅被识别为 <span class="iui">ᠩᡤ</span> ng·g，不会被识别为 <span class="iui">ᠨᡬ</span> n·gʼ。</p>
        <p>※※ <span class="su-tooltip" data-close="no" data-behavior="hover" data-my="top center" data-at="bottom center" data-classes="su-qtip qtip-plain su-qtip-size-default qtip-shadow" data-title="" data-hasqtip="3" oldtitle="表示确认（OK）" title=""><span style="text-decoration: underline; color: #808080;">O</span></span> 用于对前一字母的确认。如输入 kOk 将被识别为 k·k，而不会被识别为 kʼ。</p>
        <p>2. <strong>知蚩诗日资雌思</strong>：可以用 y 替代原本的元音字母的进行快捷输入。</p>
        <p>　　【<span class="iui">ᡷᡳ</span> jyʼ】jy　【<span class="iui">ᡱᡳ</span> qyʼ】qy　【<span class="iui">ᡧᡳ</span> xi】xy、xi　【<span class="iui">ᡰᡳ</span> rʼi】rry、Ry、rri、Ri<br>
            　　【<span class="iui">ᡯᡳ</span> zi】zy、zi　【<span class="iui">ᡮᡟ</span> cyʼ】cy　【<span class="iui">ᠰᡟ</span> syʼ】sy</p>
        <p>※ 输入 sy 将被智能识别为 <span class="iui">ᠰᡟ</span> syʼ 或 <span class="iui">ᠰᠶ</span>s·y。</p>
        <p>3. <strong>分写的格助词</strong>：可以用三连击或上档进行快捷输入。</p>
        <p>　　【<span class="iui">ᡳ᠋</span> -i】iii、yy、<span style="color:red;">I</span>、Mi　【<span class="iui">ᠨᡳ</span> ni】nnn、<span style="color:red;">N</span>、<span style="color:red;">冒号</span>、Mni　【<span class="iui">ᠴᡳ</span> qi】qqq、<span style="color:red;">Q</span>、Mqi<br>
            　　【<span class="iui">ᠪᡝ</span> be】bbb、<span style="color:red;">B</span>、Mbe　【<span class="iui">ᡩᡝ</span> de】ddd、<span style="color:red;">D</span>、Mde　【<span class="iui">ᡩᡝᡵᡳ</span> deri】dddri、<span style="color:red;">DR</span>、Mderi</p>
        <p>4. <strong>不规则拼写</strong>：可以使用多种快捷输入方式。</p>
        <p>　　【<span class="vert xanyan" style="font-size:150%;">᠊ᠨ᠋</span> -nʼ】nn、nF<br>
            　　【<span class="iui">ᡴ᠋ᡡ</span> kʼv】kvv、<span style="color:red;">kkv</span>、kFv、kvF　【<span class="iui">ᡤ᠋ᡡ</span> gʼv】gvv、<span style="color:red;">ggv</span>、gFv、gvF　【<span class="iui">ᡥ᠋ᡡ</span> hʼv】hvv、<span style="color:red;">hhv</span>、hFv、hvF</p>
        <p>5. <strong>标点符号</strong>：</p>
        <p>　　【<span class="iui">᠈</span>】,　【<span class="iui">᠄</span>】,,　【,】,,,　【<span class="iui">᠉</span>】.　【<span class="iui">᠁</span>】..　【.】...　【-】-　【–】--　【—】---<br>
            　　【上双引号】{ 或 "　【下双引号】} 或 |　【上单引号】[ 或 '　【下单引号】] 或 \<br>
            　　【¥】$　【$】$$　【·】`　【`】``　【※】^　【^】^^<br>
            　　【{】@{{　【}】}}　【[】[[　【]】]]
        </p><p>6. <strong>特别字符和控制符</strong>：</p>
        <p>　　【<span class="iui">᠇</span> ʼ】A　【<span class="iui">᠊</span> -】E<br>
            　　【FVS1】F 或 F1　【FVS2】FF 或 F2　【FVS3】FFF 或 F3　【FVS4】FFFF 或 F4<br>
            　　【ZWJ】W 或 F5　【ZWNJ】F6　【WJ】F7　【NNBSP】M 或 F8<br>
            　　【NBSP】F9　【IDSP】F0<br>
            <!-- Start Shortcoder content --></p>
        <div class="english-right">@Copy Right 2018</div>
        <a href="http://abkai.net/core/zh/online-keyboard/online-keyboard-manchu/">太清输入法：更多</a>
    </div></div>
<script>
    $('[data-url]').click(function () {

        $('[data-url]').each(function () {
            var a = $(this);

            a.removeClass("su-tabs-current");
            var id = a.attr("data-url");
            $("#" + id).hide();
        });

        $(this).addClass("su-tabs-current");
        var id = $(this).attr("data-url");
        $("#" + id).show();
    });
</script>

</body>
</html>