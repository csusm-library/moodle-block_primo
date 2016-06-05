<?php
// This file is part of Moodle - http://moodle.org/
//
// Moodle is free software: you can redistribute it and/or modify
// it under the terms of the GNU General Public License as published by
// the Free Software Foundation, either version 3 of the License, or
// (at your option) any later version.
//
// Moodle is distributed in the hope that it will be useful,
// but WITHOUT ANY WARRANTY; without even the implied warranty of
// MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
// GNU General Public License for more details.
//
// You should have received a copy of the GNU General Public License
// along with Moodle.  If not, see <http://www.gnu.org/licenses/>.

/**
 * Newblock block caps.
 *
 * @package    block_primo
 * @copyright  Nadav Kavalerchik <nadavkav@gmail.com>
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die();

class block_primo extends block_base {

    function init() {
        $this->title = get_string('pluginname', 'block_primo');
    }

    function get_content() {
        global $CFG, $OUTPUT;

        if ($this->content !== null) {
            return $this->content;
        }

        if (empty($this->instance)) {
            $this->content = '';
            return $this->content;
        }

        $this->content = new stdClass();
        $this->content->items = array();
        $this->content->icons = array();
        $this->content->footer = '';

        $config = get_config('block_primo');
        if (empty($config->accountsubdomainname)) {
            $this->content->text = get_string('erroraccountismissing', 'block_primo', $CFG->wwwroot);
            return $this->content;
        }
        
        // user/index.php expect course context, so get one if page has module context.
        $currentcontext = $this->page->context->get_course_context(false);

        if (!empty($this->config->text)) {
            $this->content->text = $this->config->text;
        }

        $this->content = '';
        if (empty($currentcontext)) {
            return $this->content;
        }

        // Following code was taken from exlibris Primo search portal 1/6/2016.
        // TODO: Should be replaced with new ALMA code, soon...
        // TODO: Clean the code & trim redundant elements.
        $primo_search_form = '<form name="searchForm" method="get" action="http://'.$config->accountsubdomainname.'.hosted.exlibrisgroup.com/primo_library/libweb/action/search.do?fn=search&amp;ct=search" class="EXLSearchForm" enctype="application/x-www-form-urlencoded; charset=utf-8" onsubmit="if(isRemoteSearch()){doPleaseWait();};if(window.manualFormSubmit){manualFormSubmit(this.id);return false;}" id="searchForm" target="_self"><input id="fn" type="hidden" value="search" name="fn">
<input id="ct" type="hidden" value="search" name="ct">
<input id="initialSearch" type="hidden" value="true" name="initialSearch">

<input id="autoCompleteEnabled" type="hidden" value="false">
<input id="autoCompleteUrl" type="hidden" value="http://primo-instant-eu.hosted.exlibrisgroup.com:1997/solr/ac">
<input id="autoCompleteScope" type="hidden" value="">
<input id="autoCompleteScopesMap" type="hidden" value="{&quot;972LEV_BAS01&quot;:&quot;L&quot;,&quot;972LEV_BAS31&quot;:&quot;L&quot;,&quot;default_scope&quot;:&quot;B&quot;,&quot;972LEV_BAS09&quot;:&quot;L&quot;,&quot;972LEV_Aleph&quot;:&quot;L&quot;,&quot;972LEV_PCI&quot;:&quot;C&quot;,&quot;972LEV_BAS03&quot;:&quot;L&quot;,&quot;972LEV_BAS02&quot;:&quot;L&quot;,&quot;972LEV_BAS13&quot;:&quot;L&quot;}">
<input id="autoCompleteEnabledMap" type="hidden" value="{&quot;972LEV_BAS01&quot;:false,&quot;972LEV_BAS31&quot;:false,&quot;default_scope&quot;:false,&quot;972LEV_BAS09&quot;:false,&quot;972LEV_PCI&quot;:false,&quot;972LEV_Aleph&quot;:false,&quot;972LEV_BAS03&quot;:false,&quot;972LEV_BAS02&quot;:false,&quot;972LEV_BAS13&quot;:true}">
<input id="instCode" type="hidden" value="972LEV">
<input id="pcToken" type="hidden" value="0">
<!-- taglibsIncludeAll.jspf begin -->
<!-- taglibsIncludeAll.jspf end --><!-- searchTileBasic.jsp begin -->
<div id="exlidSearchTile" class="EXLSearch">
<div id="exlidSearchRibbon">
<!-- search_hidden.jspf begin -->
<!-- taglibsIncludeAll.jspf begin -->
<!-- taglibsIncludeAll.jspf end --><!--
		institution = Levinsky College
		institution code = 972LEV
	 -->
	<input type="hidden" id="mode" name="mode" value="Basic">
	<input type="hidden" id="tab" name="tab" value="aleph_tab">
	<input type="hidden" id="indx" name="indx" value="1">
	<input type="hidden" id="dum" name="dum" value="true">
	<input type="hidden" name="srt" value="rank" id="str">

	<input type="hidden" id="vid" name="vid" value="972LEV_V1">
	<input type="hidden" id="frbg" name="frbg" value="">
	<!-- search_hidden.jspf end --><fieldset>
    <legend class="EXLHiddenCue">חיפוש ב Primo</legend>

<div class="EXLSearchTabsContainer">


<input type="hidden" name="tb" value="t" id="tb"><ul id="exlidSearchTabs" class="EXLTabs">
		<li id="exlidTab0" class="EXLSearchTab EXLSearchTabSelected">
				<span id="defaultScopealeph_tab" style="display:none">כל הספריות</span> <a href="search.do?mode=Basic&amp;vid=972LEV_V1&amp;tab=aleph_tab&amp;" class="EXLSearchTabTitle EXLSearchTabLABELחיפוש בקטלוג הספרייה" target="_self" onclick="getSearchField(this,\'Basic\'); delay4Remote(\'local\',\'true \',\'aleph_tab\')" title="חיפוש מקורות מקומיים בספרייה">
					<span>חיפוש בקטלוג הספרייה</span>
				</a>
			</li>
		<li id="exlidTab1" class="EXLSearchTab ">
				<span id="defaultScopepci" style="display:none">972LEV PCI</span> <a href="search.do?mode=Basic&amp;vid=972LEV_V1&amp;tab=pci&amp;" class="EXLSearchTabTitle EXLSearchTabLABELחיפוש מאמרים" target="_self" onclick="getSearchField(this,\'Basic\'); delay4Remote(\'local\',\'true \',\'pci\')" title="מאמרים וספרים אלקטרוניים">
					<span>חיפוש מאמרים</span>
				</a>
			</li>
		<li id="exlidTab2" class="EXLSearchTab ">
				<span id="defaultScopedefault_tab" style="display:none">הכל</span> <a href="search.do?mode=Basic&amp;vid=972LEV_V1&amp;tab=default_tab&amp;" class="EXLSearchTabTitle EXLSearchTabLABELחיפוש כולל (קטלוג הספרייה ומאמרים)" target="_self" onclick="getSearchField(this,\'Basic\'); delay4Remote(\'local\',\'true \',\'default_tab\')" title="כל מקורות המידע - ספרים, מאמרים ועוד">
					<span>חיפוש כולל (קטלוג הספרייה ומאמרים)</span>
				</a>
			</li>
		</ul>

</div>
<div class="EXLSearchFieldRibbon ">
      <div class="EXLSearchFieldRibbonFormFields">
        <div class="EXLSearchFieldRibbonFormSearchFor">
          <label for="search_field" class="EXLHide">חיפוש:</label>
          <input name="vl(freeText0)" class="" value="" id="search_field" type="text" accesskey="s">
										
        </div>
        <div class="EXLSearchFieldRibbonFormSearchClear" style="visibility: hidden;">
        	<a class="EXLClearSearchBoxButton EXLClearSimpleSearchBoxButton" id="exlidClearSearchBox" title="Clear Search Term" href="#">
				<span class="EXLHiddenCue">מחיקת תוכן משבצת חיפוש</span><span class="EXLClearSimpleSearchBoxButtonClose">
				</span>
			</a>	
        </div>


<!-- taglibsIncludeAll.jspf begin -->
<!-- taglibsIncludeAll.jspf end --><div id="scopesList">
<div class="EXLSearchFieldRibbonFormSelectedCollection ">
	 <span class="EXLSearchFieldRibbonFormSelectedCollectionLabel">
			<a id="showMoreOptions" href="#" title="Selected search target">
			<input class="EXLSelectedScopeId" type="hidden" value="972LEV_Aleph">
			<span class="EXLHiddenCue">חיפוש ב:</span>
			<span class="EXLSearchFieldStrippedText">
	             כל הספריות</span>
			  <span class="EXLHiddenCue">או הקישו על ENTER לשינוי יעד החיפוש</span>
			</a>
		</span>
		</div>

<div class="EXLSearchFieldRibbonFormCollectionsList" style="display:none"><span class="EXLHiddenCue">Or select another collection:</span>
     <div id="scopesListContainer" class="EXLDynamicSelectBodyRadio">
     <div class="EXLDynamicSelectBodyRadioFirst" id="972LEV_Aleph-Div">
			<a href="#" class="EXLDynamicSelectBodyRadioFirst">
			  <span class="EXLHiddenCue">Search in:</span>
			  <span class="EXLSearchFieldStrippedText">
	              <input name="scp.scps" type="radio" checked="checked" id="exlidDynamicSelectBodyRadio0" value="scope:(&quot;972LEV&quot;)">
	              <label for="exlidDynamicSelectBodyRadio0">
	                   כל הספריות</label>
			</span>
			  </a>
            </div>
		<div class="" id="972LEV_BAS01-Div">
			<a href="#" class="">
			  <span class="EXLHiddenCue">יחפוש ב:</span>
			  <span class="EXLSearchFieldStrippedText">
	              <input name="scp.scps" type="radio" id="exlidDynamicSelectBodyRadio1" value="scope:(972LEV_BAS01)">
	              <label for="exlidDynamicSelectBodyRadio1">
	                   ספרייה מרכזית</label>
			</span>
			  </a>
            </div>
		<div class="" id="972LEV_BAS02-Div">
			<a href="#" class="">
			  <span class="EXLHiddenCue">Search in:</span>
			  <span class="EXLSearchFieldStrippedText">
	              <input name="scp.scps" type="radio" id="exlidDynamicSelectBodyRadio2" value="scope:(972LEV_BAS02)">
	              <label for="exlidDynamicSelectBodyRadio2">
	                   ספרייה אורקולית</label>
			</span>
			  </a>
            </div>
		<div class="" id="972LEV_BAS03-Div">
			<a href="#" class="">
			  <span class="EXLHiddenCue">Search in:</span>
			  <span class="EXLSearchFieldStrippedText">
	              <input name="scp.scps" type="radio" id="exlidDynamicSelectBodyRadio3" value="scope:(972LEV_BAS03)">
	              <label for="exlidDynamicSelectBodyRadio3">
	                   ספריית המוסיקה </label>
			</span>
			  </a>
            </div>
		<div class="" id="972LEV_BAS13-Div">
			<a href="#" class="">
			  <span class="EXLHiddenCue">Search in:</span>
			  <span class="EXLSearchFieldStrippedText">
	              <input name="scp.scps" type="radio" id="exlidDynamicSelectBodyRadio4" value="scope:(972LEV_BAS13)">
	              <label for="exlidDynamicSelectBodyRadio4">
	                   התזמורת הפילהרמונית הישראלית - מאמרים</label>
			</span>
			  </a>
            </div>
		<div class="" id="972LEV_BAS09-Div">
			<a href="#" class="">
			  <span class="EXLHiddenCue">Search in:</span>
			  <span class="EXLSearchFieldStrippedText">
	              <input name="scp.scps" type="radio" id="exlidDynamicSelectBodyRadio5" value="scope:(972LEV_BAS09)">
	              <label for="exlidDynamicSelectBodyRadio5">
	                   קונסרבטוריון רון שולמית (ירושלים)</label>
			</span>
			  </a>
            </div>
		<div class="" id="972LEV_BAS31-Div">
			<a href="#" class="">
			  <span class="EXLHiddenCue">Search in:</span>
			  <span class="EXLSearchFieldStrippedText">
	              <input name="scp.scps" type="radio" id="exlidDynamicSelectBodyRadio6" value="scope:(972LEV_BAS31)">
	              <label for="exlidDynamicSelectBodyRadio6">
	                   ארכיון מרכז לוין קיפניס לספרות ילדים</label>
			</span>
			  </a>
            </div>
		</div>

</div>
  </div>
  </div>
<!-- end  search field ribbon -->
      <div class="EXLSearchFieldRibbonFormSubmitSearch">
		<input id="goButton" type="submit" value="חיפוש" class="submit" accesskey="g">
      </div>

    </div>
    </fieldset>
<div class="EXLSearchFieldRibbonAdvancedSearchLink">
	<a class="EXLSearchFieldRibbonAdvancedTwoLinks" title="חיפוש מתקדם" href="search.do?mode=Advanced&amp;ct=AdvancedSearch&amp;vid=972LEV_V1&amp;dscnt=0&amp;dstmp=1464820778614" id="advancedSearchBtn">חיפוש מתקדם</a>
</div>

<div class="EXLSearchFieldRibbonBrowseSearchLink">
	<a class="EXLSearchFieldRibbonAdvancedTwoLinks" title="דפדוף" href="search.do?fn=showBrowse&amp;mode=BrowseSearch&amp;vid=972LEV_V1&amp;dscnt=0&amp;dstmp=1464820778614">דפדוף</a>
</div>
</div>
<div id="exlidSearchBanner">
<a href="search.do" target="_popup">
	          <img src="http://levinsky-primo.hosted.exlibrisgroup.com/primo_library/libweb/locale/iw_IL/images/banner.png" alt="rss">
	        </a>
</div>
<!--end exlidSearchBanner-->
</div>
<!-- searchTileBasic.jsp end --><!-- taglibsIncludeAll.jspf begin -->
<!-- taglibsIncludeAll.jspf end --><script type="text/javascript"> // <![CDATA[

function removeChildren(elm){
	if ( elm.hasChildNodes() )
	{
    		while ( elm.childNodes.length >= 1 )
    		{
        			elm.removeChild( elm.firstChild );
    		}
	}
}


function loopSelected(selObj, newObj, selectedElm)
{

	for (i=0; i<selObj.options.length; i++) {
		var op = document.createElement(\'option\');
		op.text = selObj.options[i].text;
		op.value = selObj.options[i].value;
		op.id = selObj.options[i].id;
		if (selectedElm == selObj.options[i].value ){
			op.selected = \'selected\';
		}
		try {
  			newObj.add(op, newObj.options[i]); // firefox
		} catch (ex) {
  			newObj.add(op, i); // ie
		}
	}
}


function showSelected(selectedOption, id  ) {

		var selOperatorObj = document.getElementById(\'exlidInput_precisionOperator_\' +id);
		var selOperatorIndex = selOperatorObj.selectedIndex;
		var titleObj=document.getElementById(\'exlidInput_scope_title\' +id);

		var allObj =document.getElementById(\'exlidInput_scope_all\' +id);
		var orgObj = document.getElementById(\'exlidInput_scope_\' +id);
		var selectedElm =orgObj.options[orgObj.selectedIndex];

		if ( selOperatorObj.options[selOperatorIndex].value ==\'begins_with\'){
			if (titleObj == null || titleObj == undefined ){
				selectedOption.options[0].selected = \'selected\';
				alert(\'אפשר להשתמש במתחיל ב- רק לחיפוש בכותר\');
				return false;
			}
			removeChildren(orgObj);
			loopSelected(titleObj, orgObj, selectedElm.value);
			var searchForm = document.getElementsByName(\'searchForm\')[0];
			var hiddenSrt = document.getElementById("str");
			hiddenSrt.value = \'title\';
		} else{
			removeChildren(orgObj);
			loopSelected(allObj, orgObj, selectedElm.value);
			var searchForm = document.getElementsByName(\'searchForm\')[0];
			var hiddenSrt = document.getElementById("str");
			hiddenSrt.value = \'rank\';
		}

}

function unselect(id  ) {

	 	 if (document.getElementById(\'begins_with\'+id)) {
			var orgObj = document.getElementById(\'exlidInput_scope_\' +id);
			removeChildren(orgObj);
			var op = document.createElement(\'option\');
			op.text = \'בכותר\';
			op.value = \'title\';
			op.id = \'scope_titleOnly\'+id;
			op.selected = \'selected\';
			try {
  				orgObj.add(op, orgObj.options[0]); // firefox
			} catch (ex) {
  				orgObj.add(op, 0); // ie
			}
			var searchForm = document.getElementsByName(\'searchForm\')[0];
			var hiddenSrt = document.getElementById("str");
			hiddenSrt.value = \'title\';
		}
}

function unselectAdvanceTitle(id){

	if (document.getElementById(\'title\'+id)) {
		var orgObj = document.getElementById(\'exlidInput_scope_\' +id);
		removeChildren(orgObj);
		var op = document.createElement(\'option\');
		op.text = \'בכותר\';
		op.value = \'title\';
		op.id = \'scope_titleOnly\'+id;
		op.selected = \'selected\';
		try {
			orgObj.add(op, orgObj.options[0]); // firefox
		} catch (ex) {
			orgObj.add(op, 0); // ie
		}
		var searchForm = document.getElementsByName(\'searchForm\')[0];
		var hiddenSrt = document.getElementById("str");
		hiddenSrt.value = \'title\';
	}
}


//]]>
</script>
<noscript>This feature requires javascript</noscript><!-- searchLimitsTile.jsp begin -->
<div id="exlidHeaderSearchLimits">
      <fieldset>
      <legend class="EXLHiddenCue"><!-- userText.tag begin -->
<!-- userText.tag end --></legend>      
      <span class="EXLHeaderSearchLimitsFields">
		<span class="EXLHeaderSearchLimitsFieldsTitle">
		<!-- userText.tag begin -->
<!-- userText.tag end --></span>

		<span class="EXLHiddenCue"><!-- userText.tag begin -->
חפש:<!-- userText.tag end --></span>
				<!-- select.tag begin -->
<!-- taglibsIncludeAll.jspf begin -->
<!-- taglibsIncludeAll.jspf end --><label class="EXLHide" for="exlidInput_mediaType_1">סוג</label>
		 <select class="EXLSelectTag blue EXLSimpleSearchSelect" id="exlidInput_mediaType_1" name="vl(280764664UI1)">


			<option style="display:block" value="journals" id="mediaType_journals1" class="EXLSelectOption">
							כתבי עת</option>
				<option style="display:block" value="local01s" id="mediaType_local01s1" class="EXLSelectOption">
							הקלטות שמע</option>
				<option style="display:block" value="local02s" id="mediaType_local02s1" class="EXLSelectOption">
							הקלטות וידאו</option>
				<option style="display:block" value="images" id="mediaType_images1" class="EXLSelectOption">
							תמונות</option>
				<option style="display:block" value="articles" id="mediaType_articles1" class="EXLSelectOption">
							מאמרים</option>
				<option style="display:block" value="scores" id="mediaType_scores1" class="EXLSelectOption">
							תווים</option>
				<option style="display:block" value="books" id="mediaType_books1" class="EXLSelectOption">
							ספרים</option>
				<option style="display:block" value="dissertations" id="mediaType_dissertations1" class="EXLSelectOption">
							עבודות מחקר</option>
				<option style="display:block" value="all_items" id="mediaType_all_items1" selected="selected" class="EXLSelectedOption">
							כל סוגי החומר</option>
				</select>
		 <!-- select.tag end --><span class="EXLHide">
				<br><span class="EXLHide">הצגת תוצאות עם:</span>
				</span>
				<!-- select.tag begin -->
<!-- taglibsIncludeAll.jspf begin -->
<!-- taglibsIncludeAll.jspf end --><label class="EXLHide" for="exlidInput_precisionOperator_1">שיטת חיפוש</label>
		 <select class="EXLSelectTag blue EXLSimpleSearchSelect" id="exlidInput_precisionOperator_1" onchange="showSelected(this, \'1\' ); return false;" name="vl(1UIStartWith0)">


			<option value="contains" selected="selected" class="EXLSelectedOption">
						עם מילות החיפוש</option>
				<option value="exact" class="EXLSelectOption">
						עם הביטוי המדויק</option>
				<option value="begins_with" class="EXLSelectOption">
						מתחיל ב</option>
				</select>
		 <!-- select.tag end --><span class="EXLHide">
				<br><span class="EXLHide">הצגת תוצאות עם:</span>
				<!-- userText.tag begin -->
<!-- userText.tag end --></span>
				<!-- select.tag begin -->
<!-- taglibsIncludeAll.jspf begin -->
<!-- taglibsIncludeAll.jspf end --><label class="EXLHide" for="exlidInput_scope_1">שדה תוכן</label>
		<select class="EXLSelectTag blue EXLSimpleSearchSelect" id="exlidInput_scope_1" name="vl(9151182UI0)">
			<option value="any" id="scope_any1" selected="selected" class="EXLSelectedOption">
							בכל מקום</option>
				<option value="title" id="scope_title1" class="EXLSelectOption">
							בכותר</option>
				<option value="creator" id="scope_creator1" class="EXLSelectOption">
							מתוך שם המחבר/יוצר</option>
				<option value="sub" id="scope_sub1" class="EXLSelectOption">
							מילים מנושא</option>
				<option value="lsr05" id="scope_lsr051" class="EXLSelectOption">
							נושא ספרות ילדים</option>
				<option value="lsr06" id="scope_lsr061" class="EXLSelectOption">
							נושא מדיה</option>
				<option value="lsr07" id="scope_lsr071" class="EXLSelectOption">
							נושא מוסיקה</option>
				<option value="lsr08" id="scope_lsr081" class="EXLSelectOption">
							נושא מוסיקה שיר</option>
				<option value="lsr09" id="scope_lsr091" class="EXLSelectOption">
							כותר שיר (שם השיר)</option>
				<option value="lsr10" id="scope_lsr101" class="EXLSelectOption">
							מו"ל</option>
				<option value="lsr11" id="scope_lsr111" class="EXLSelectOption">
							מספר מדף/ מיון</option>
				<option value="lsr12" id="scope_lsr121" class="EXLSelectOption">
							תורם</option>
				<option value="lsr13" id="scope_lsr131" class="EXLSelectOption">
							מרצה</option>
				<option value="lsr14" id="scope_lsr141" class="EXLSelectOption">
							קורס</option>
				<option value="lsr15" id="scope_lsr151" class="EXLSelectOption">
							רשומות חדשות ( שנה חודש  yyyymm)</option>
				<option value="lsr04" id="scope_lsr041" class="EXLSelectOption">
							סוג חומר</option>
				<option value="lsr03" id="scope_lsr031" class="EXLSelectOption">
							מספר מערכת</option>
				</select>


			<label class="EXLHide" for="exlidInput_scope_title1">Show Results with:</label>
				  	<select class="EXLSelectTag blue EXLSimpleSearchSelect" id="exlidInput_scope_title1" name="vl(9151182UI0)" style="display:none">
					<option value="title" id="scope_titleOnly1" selected="selected" class="EXLSelectOption">
						בכותר</option>
					</select>
				<label class="EXLHide" for="exlidInput_scope_all1">Show Results with:</label>
		<select class="EXLSelectTag blue EXLSimpleSearchSelect" id="exlidInput_scope_all1" name="vl(9151182UI0)" style="display:none">
			<option style="display:block" value="any" id="scope_anyall1" selected="selected" class="EXLSelectedOption">
							בכל מקום</option>
				<option style="display:block" value="title" id="scope_titleall1" class="EXLSelectOption">
							בכותר</option>
				<option style="display:block" value="creator" id="scope_creatorall1" class="EXLSelectOption">
							מתוך שם המחבר/יוצר</option>
				<option style="display:block" value="sub" id="scope_suball1" class="EXLSelectOption">
							מילים מנושא</option>
				<option style="display:block" value="lsr05" id="scope_lsr05all1" class="EXLSelectOption">
							נושא ספרות ילדים</option>
				<option style="display:block" value="lsr06" id="scope_lsr06all1" class="EXLSelectOption">
							נושא מדיה</option>
				<option style="display:block" value="lsr07" id="scope_lsr07all1" class="EXLSelectOption">
							נושא מוסיקה</option>
				<option style="display:block" value="lsr08" id="scope_lsr08all1" class="EXLSelectOption">
							נושא מוסיקה שיר</option>
				<option style="display:block" value="lsr09" id="scope_lsr09all1" class="EXLSelectOption">
							כותר שיר (שם השיר)</option>
				<option style="display:block" value="lsr10" id="scope_lsr10all1" class="EXLSelectOption">
							מו"ל</option>
				<option style="display:block" value="lsr11" id="scope_lsr11all1" class="EXLSelectOption">
							מספר מדף/ מיון</option>
				<option style="display:block" value="lsr12" id="scope_lsr12all1" class="EXLSelectOption">
							תורם</option>
				<option style="display:block" value="lsr13" id="scope_lsr13all1" class="EXLSelectOption">
							מרצה</option>
				<option style="display:block" value="lsr14" id="scope_lsr14all1" class="EXLSelectOption">
							קורס</option>
				<option style="display:block" value="lsr15" id="scope_lsr15all1" class="EXLSelectOption">
							רשומות חדשות ( שנה חודש  yyyymm)</option>
				<option style="display:block" value="lsr04" id="scope_lsr04all1" class="EXLSelectOption">
							סוג חומר</option>
				<option style="display:block" value="lsr03" id="scope_lsr03all1" class="EXLSelectOption">
							מספר מערכת</option>
				</select>
		<!-- select.tag end --><!-- userText.tag begin -->
<!-- userText.tag end --><input name="Submit" type="submit" value="Apply Search Limits">

      <input name="Reset" type="reset" value="Clear Limits">
      </span>
      </fieldset>
</div>
<!-- searchLimitsTile.jsp end -->
</form>';

        $this->content->text = $primo_search_form;
        if (!empty($this->config->text)) {
            $this->content->text .= $this->config->text;
        }

        return $this->content;
    }

    // my moodle can only have SITEID and it's redundant here, so take it away
    public function applicable_formats() {
        return array('all' => false,
                     'site' => true,
                     'site-index' => true,
                     'course-view' => true, 
                     'course-view-social' => false,
                     'mod' => true, 
                     'mod-quiz' => false);
    }

    // One is enough.
    public function instance_allow_multiple() {
          return false;
    }

    function has_config() {return true;}
}
