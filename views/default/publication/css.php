<?php

	/**
         * @package Elgg         
	 * @license http://www.gnu.org/licenses/old-licenses/gpl-2.0.html GNU Public License version 2
         * @author Roger Curry, Grid Research Centre [curry@cpsc.ucalgary.ca]
         * @author Tingxi Tan, Grid Research Centre [txtan@cpsc.ucalgary.ca]
         * @link http://grc.ucalgary.ca/
         */


?>
#open_import_form {
    margin:0px 0 10px 10px;
}

#add_new_import {
  display:none;
  margin:20px 0 0 0;
}

#add_new_import form {
    padding:10px;
}

#add_new_import input{
        padding:3px 0;
        width:188px;
}

.add_export{
        font: 12px/100% Arial, Helvetica, sans-serif;
        font-weight: bold;
        color: #ffffff;
        background:#000000;
        -webkit-border-radius: 3px;
        -moz-border-radius: 3px;
        padding: 2px 6px 2px 6px;
        margin:20px 0 10px 0;
        cursor: pointer;
}
.add_import{
        font: 12px/100% Arial, Helvetica, sans-serif;
        font-weight: bold;
        color: #ffffff;
        background:#000000;
        -webkit-border-radius: 3px;
        -moz-border-radius: 3px;
        padding: 2px 6px 2px 6px;
        margin:20px 0 10px 0;
        cursor: pointer;
}

.add_export:hover {
        background: #8b000b;
        color: #ffffff;
        text-decoration: none;
}
.add_import:hover {
        background: #8b000b;
        color: #ffffff;
        text-decoration: none;
}


.tagpubspan{
	float:right;
	margin-left:10px;
}

.tagpubBtn{
        -webkit-border-radius:5px;
        -moz-border-radius:5px;
        -moz-background-clip:border;
        -moz-background-origin:padding;
        -moz-background-inline-policy:continuous;
        color:white;
        background-color:#4690D6;
        cursor:pointer;
        height:auto;
        width:auto;
        line-height:100%;
        font-weight:bold;
        padding:5px;
        float:left;
        margin-left:10px;
        font-size:12px;
}

.tagpubBtn:hover{
	background-color:#0054A7;
        cursor:pointer;
        text-decoration:none;
}

/*a.embed_media{
	margin:0;
        float:right;
        display:block;
        text-align: right;
        font-size:1.0em;
        font-weight: normal;
	-moz-border-radius:5px;
	border:1px solid #CCCCCC;
	padding:5px;
}
a.embed_media:hover{
	background-color:#e0e0e0;
        text-decoration:none;
        cursor:pointer;
}*/

.authorentrybutton{
	//-moz-border-radius:5px;
	//border:1px solid #CCCCCC;
	//padding:3px;
}
.authorentrybutton:hover{
	//background-color:#e0e0e0;
	//text-decoration:none;
	//cursor:pointer;
}

#authortable td{
	overflow:auto;
	padding:0px 5px 0px 5px;
}

.publication_searchbox{
	margin:0px 0px 10px 10px;
}
.publication_dialog{
	background:#FFFFFF;
	padding:20px;
	z-index:10001;
	position:fixed;
	top:40%;
	left:40%;
	float:right
	-webkit-border-radius:8px;
	-moz-border-radius:8px;
	border:2px solid #CCCCCC;
}

.singleview {
	margin-top:10px;
}

.publication_post_icon {
	float:left;
	margin:3px 0 0 0;
	padding:0;
}

.publication_post h3 {
	font-size: 150%;
	margin:0 0 10px 0;
	padding:0;
}

.publication_post h3 a {
	text-decoration: none;
}

.publication_post p {
	margin: 0 0 5px 0;
}

.publication_post .strapline {
	margin: 0 0 0 35px;
	padding:0;
	color: #aaa;
	line-height:1em;
}
.publication_post p.tags {
	background:transparent url(<?php echo $vars['url']; ?>_graphics/icon_tag.gif) no-repeat scroll left 2px;
	margin:0 0 7px 35px;
	padding:0pt 0pt 0pt 16px;
	min-height:22px;
}
.publication_post .options {
	margin:0;
	padding:0;
}

.publication_post_body img[align="left"] {
	margin: 10px 10px 10px 0;
	float:left;
}
.publication_post_body img[align="right"] {
	margin: 10px 0 10px 10px;
	float:right;
}
.publication_post_body img {
	margin: 10px !important;
}

.publication-comments h3 {
	font-size: 150%;
	margin-bottom: 10px;
}
.publication-comment {
	margin-top: 10px;
	margin-bottom:20px;
	border-bottom: 1px solid #aaaaaa;
}
.publication-comment img {
	float:left;
	margin: 0 10px 0 0;
}
.publication-comment-menu {
	margin:0;
}
.publication-comment-byline {
	background: #dddddd;
	height:22px;
	padding-top:3px;
	margin:0;
}
.publication-comment-text {
	margin:5px 0 5px 0;
}

/* New publication edit column */
#publication_edit_page {
	/* background: #bbdaf7; */
	margin-top:-10px;
}
#publication_edit_page #content_area_user_title h2 {
	background: none;
	border-top: none;
	margin:0 0 10px 0px;
	padding:0px 0 0 0;
}
#publication_edit_page #publication_edit_sidebar #content_area_user_title h2 {
	background:none;
	border-top:none;
	margin:inherit;
	padding:0 0 5px 5px;
	font-size:1.25em;
	line-height:1.2em;
}
#publication_edit_page #publication_edit_sidebar {
	margin:0px 0 22px 0;
	background: #dedede;
	padding:5px;
	-webkit-border-radius: 8px; 
	-moz-border-radius: 8px;
	border-bottom:1px solid #cccccc;
	border-right:1px solid #cccccc;
}
#publication_edit_page #two_column_left_sidebar_210 {
	width:210px;
	margin:0px 0 20px 0px;
	min-height:360px;
	float:left;
	padding:0;
}
#publication_edit_page #two_column_left_sidebar_maincontent {
	margin:0 0px 20px 20px;
	padding:10px 20px 20px 20px;
	width:670px;
	background: #bbdaf7;
}

#publication_edit_sidebar .publish_controls,
#publication_edit_sidebar .publication_access,
#publication_edit_sidebar .publish_options,
#publication_edit_sidebar .publish_publication,
#publication_edit_sidebar .allow_comments,
#publication_edit_sidebar .categories {
	margin:0 5px 5px 5px;
	border-top:1px solid #cccccc;
}
#publication_edit_page ul {
	padding-left:0px;
	margin:5px 0 5px 0;
	list-style: none;
}
#publication_edit_page p {
	margin:5px 0 5px 0;
}
#publication_edit_page #two_column_left_sidebar_maincontent p {
	margin:0 0 15px 0;
}
#publication_edit_page .publish_publication input[type="submit"] {
	font-weight: bold;
	padding:2px;
	height:auto;
}
#publication_edit_page .preview_button a {
	font: 12px/100% Arial, Helvetica, sans-serif;
	font-weight: bold;
	background:white;
	border: 1px solid #cccccc;
	color:#999999;
	-webkit-border-radius: 4px; 
	-moz-border-radius: 4px;
	width: auto;
	height: auto;
	padding: 3px;
	margin:1px 1px 5px 10px;
	cursor: pointer;
	float:right;
}
#publication_edit_page .preview_button a:hover {
	background:#4690D6;
	color:white;
	text-decoration: none;
	border: 1px solid #4690D6;
}
#publication_edit_page .allow_comments label {
	font-size: 100%;
}






