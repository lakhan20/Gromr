<?php
namespace PHPReportMaker12\project1;

// Session
if (session_status() !== PHP_SESSION_ACTIVE)
	session_start(); // Init session data

// Output buffering
ob_start();

// Autoload
include_once "rautoload.php";
?>
<?php

// Create page object
if (!isset($Product_Report__summary))
	$Product_Report__summary = new Product_Report__summary();
if (isset($Page))
	$OldPage = $Page;
$Page = &$Product_Report__summary;

// Run the page
$Page->run();

// Setup login status
SetClientVar("login", LoginStatus());
if (!$DashboardReport)
	WriteHeader(FALSE);

// Global Page Rendering event (in rusrfn*.php)
Page_Rendering();

// Page Rendering event
$Page->Page_Render();
?>
<?php if (!$DashboardReport) { ?>
<?php include_once "rheader.php" ?>
<?php } ?>
<?php if ($Page->Export == "" || $Page->Export == "print") { ?>
<script>
currentPageID = ew.PAGE_ID = "summary"; // Page ID
</script>
<?php } ?>
<?php if ($Page->Export == "" && !$Page->DrillDown && !$DashboardReport) { ?>
<script>
// Form object
var fProduct_Report_summary = currentForm = new ew.Form("fProduct_Report_summary");

// Validate method
fProduct_Report_summary.validate = function() {
    if (!this.validateRequired)
        return true; // Ignore validation
    var $ = jQuery,
        fobj = this.getForm(),
        $fobj = $(fobj),
        elm;

    // Call Form Custom Validate event
    if (!this.Form_CustomValidate(fobj))
        return false;
    return true;
}

// Form_CustomValidate method
fProduct_Report_summary.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

    // Your custom validation code here, return false if invalid.
    return true;
}
<?php if (CLIENT_VALIDATE) { ?>
fProduct_Report_summary.validateRequired = true; // Uses JavaScript validation
<?php } else { ?>
fProduct_Report_summary.validateRequired = false; // No JavaScript validation
<?php } ?>

// Use Ajax
fProduct_Report_summary.lists["x_pname"] = <?php echo $Product_Report__summary->pname->Lookup->toClientList() ?>;
fProduct_Report_summary.lists["x_pname"].options =
    <?php echo JsonEncode($Product_Report__summary->pname->lookupOptions()) ?>;
fProduct_Report_summary.lists["x_brand"] = <?php echo $Product_Report__summary->brand->Lookup->toClientList() ?>;
fProduct_Report_summary.lists["x_brand"].options =
    <?php echo JsonEncode($Product_Report__summary->brand->lookupOptions()) ?>;
fProduct_Report_summary.lists["x_bussiness_name"] =
    <?php echo $Product_Report__summary->bussiness_name->Lookup->toClientList() ?>;
fProduct_Report_summary.lists["x_bussiness_name"].options =
    <?php echo JsonEncode($Product_Report__summary->bussiness_name->lookupOptions()) ?>;
fProduct_Report_summary.lists["x_categoryname"] =
    <?php echo $Product_Report__summary->categoryname->Lookup->toClientList() ?>;
fProduct_Report_summary.lists["x_categoryname"].options =
    <?php echo JsonEncode($Product_Report__summary->categoryname->lookupOptions()) ?>;
fProduct_Report_summary.lists["x_subcategoryname"] =
    <?php echo $Product_Report__summary->subcategoryname->Lookup->toClientList() ?>;
fProduct_Report_summary.lists["x_subcategoryname"].options =
    <?php echo JsonEncode($Product_Report__summary->subcategoryname->lookupOptions()) ?>;
</script>
<?php } ?>
<?php if ($Page->Export == "" && !$Page->DrillDown && !$DashboardReport) { ?>
<script>
// Write your client script here, no need to add script tags.
</script>
<?php } ?>
<a id="top"></a>
<?php if ($Page->Export == "" && !$DashboardReport) { ?>
<!-- Content Container -->
<div id="ew-container" class="container-fluid ew-container">
    <?php } ?>
    <?php if (ReportParam("showfilter") === TRUE) { ?>
    <?php $Page->showFilterList(TRUE) ?>
    <?php } ?>
    <div class="btn-toolbar ew-toolbar">
        <?php
if (!$Page->DrillDownInPanel) {
	$Page->ExportOptions->render("body");
	$Page->SearchOptions->render("body");
	$Page->FilterOptions->render("body");
	$Page->GenerateOptions->render("body");
}
?>
    </div>
    <?php $Page->showPageHeader(); ?>
    <?php $Page->showMessage(); ?>
    <?php if ($Page->Export == "" && !$DashboardReport) { ?>
    <div class="row">
        <?php } ?>
        <?php if ($Page->Export == "" && !$DashboardReport) { ?>
        <!-- Center Container - Report -->
        <div id="ew-center" class="<?php echo $Product_Report__summary->CenterContentClass ?>">
            <?php } ?>
            <!-- Summary Report begins -->
            <div id="report_summary">
                <?php if ($Page->Export == "" && !$Page->DrillDown && !$DashboardReport) { ?>
                <!-- Search form (begin) -->
                <?php

	// Render search row
	$Page->resetAttributes();
	$Page->RowType = ROWTYPE_SEARCH;
	$Page->renderRow();
?>
                <form name="fProduct_Report_summary" id="fProduct_Report_summary"
                    class="form-inline ew-form ew-ext-filter-form" action="<?php echo CurrentPageName() ?>">
                    <?php $searchPanelClass = ($Page->Filter <> "") ? " show" : " show"; ?>
                    <div id="fProduct_Report_summary-search-panel"
                        class="ew-search-panel collapse<?php echo $searchPanelClass ?>">
                        <input type="hidden" name="cmd" value="search">
                        <div id="r_1" class="ew-row d-sm-flex">
                            <div id="c_pname" class="ew-cell form-group">
                                <label for="x_pname"
                                    class="ew-search-caption ew-label"><?php echo $Page->pname->caption() ?></label>
                                <span class="ew-search-field">
                                    <div class="input-group">
                                        <select class="custom-select ew-custom-select" data-table="Product_Report_"
                                            data-field="x_pname"
                                            data-value-separator="<?php echo $Page->pname->displayValueSeparatorAttribute() ?>"
                                            id="x_pname" name="x_pname" <?php echo $Page->pname->editAttributes() ?>>
                                            <?php echo $Page->pname->selectOptionListHtml("x_pname") ?>
                                        </select>
                                    </div>
                                    <?php echo $Page->pname->Lookup->getParamTag("p_x_pname") ?>
                                </span>
                            </div>
                        </div>
                        <div id="r_2" class="ew-row d-sm-flex">
                            <div id="c_brand" class="ew-cell form-group">
                                <label for="x_brand"
                                    class="ew-search-caption ew-label"><?php echo $Page->brand->caption() ?></label>
                                <span class="ew-search-field">
                                    <div class="input-group">
                                        <select class="custom-select ew-custom-select" data-table="Product_Report_"
                                            data-field="x_brand"
                                            data-value-separator="<?php echo $Page->brand->displayValueSeparatorAttribute() ?>"
                                            id="x_brand" name="x_brand" <?php echo $Page->brand->editAttributes() ?>>
                                            <?php echo $Page->brand->selectOptionListHtml("x_brand") ?>
                                        </select>
                                    </div>
                                    <?php echo $Page->brand->Lookup->getParamTag("p_x_brand") ?>
                                </span>
                            </div>
                        </div>
                        <div id="r_3" class="ew-row d-sm-flex">
                            <div id="c_bussiness_name" class="ew-cell form-group">
                                <label for="x_bussiness_name"
                                    class="ew-search-caption ew-label"><?php echo $Page->bussiness_name->caption() ?></label>
                                <span class="ew-search-field">
                                    <div class="input-group">
                                        <select class="custom-select ew-custom-select" data-table="Product_Report_"
                                            data-field="x_bussiness_name"
                                            data-value-separator="<?php echo $Page->bussiness_name->displayValueSeparatorAttribute() ?>"
                                            id="x_bussiness_name" name="x_bussiness_name"
                                            <?php echo $Page->bussiness_name->editAttributes() ?>>
                                            <?php echo $Page->bussiness_name->selectOptionListHtml("x_bussiness_name") ?>
                                        </select>
                                    </div>
                                    <?php echo $Page->bussiness_name->Lookup->getParamTag("p_x_bussiness_name") ?>
                                </span>
                            </div>
                        </div>
                        <div id="r_4" class="ew-row d-sm-flex">
                            <div id="c_categoryname" class="ew-cell form-group">
                                <label for="x_categoryname"
                                    class="ew-search-caption ew-label"><?php echo $Page->categoryname->caption() ?></label>
                                <span class="ew-search-field">
                                    <div class="input-group">
                                        <select class="custom-select ew-custom-select" data-table="Product_Report_"
                                            data-field="x_categoryname"
                                            data-value-separator="<?php echo $Page->categoryname->displayValueSeparatorAttribute() ?>"
                                            id="x_categoryname" name="x_categoryname"
                                            <?php echo $Page->categoryname->editAttributes() ?>>
                                            <?php echo $Page->categoryname->selectOptionListHtml("x_categoryname") ?>
                                        </select>
                                    </div>
                                    <?php echo $Page->categoryname->Lookup->getParamTag("p_x_categoryname") ?>
                                </span>
                            </div>
                        </div>
                        <div id="r_5" class="ew-row d-sm-flex">
                            <div id="c_subcategoryname" class="ew-cell form-group">
                                <label for="x_subcategoryname"
                                    class="ew-search-caption ew-label"><?php echo $Page->subcategoryname->caption() ?></label>
                                <span class="ew-search-field">
                                    <div class="input-group">
                                        <select class="custom-select ew-custom-select" data-table="Product_Report_"
                                            data-field="x_subcategoryname"
                                            data-value-separator="<?php echo $Page->subcategoryname->displayValueSeparatorAttribute() ?>"
                                            id="x_subcategoryname" name="x_subcategoryname"
                                            <?php echo $Page->subcategoryname->editAttributes() ?>>
                                            <?php echo $Page->subcategoryname->selectOptionListHtml("x_subcategoryname") ?>
                                        </select>
                                    </div>
                                    <?php echo $Page->subcategoryname->Lookup->getParamTag("p_x_subcategoryname") ?>
                                </span>
                            </div>
                        </div>
                        <div class="ew-row d-sm-flex">
                            <button type="submit" name="btn-submit" id="btn-submit"
                                class="btn btn-primary"><?php echo $ReportLanguage->phrase("Search") ?></button>
                            <button type="reset" name="btn-reset" id="btn-reset"
                                class="btn hide"><?php echo $ReportLanguage->phrase("Reset") ?></button>
                        </div>
                    </div>
                </form>
                <script>
                fProduct_Report_summary.filterList = <?php echo $Page->getFilterList() ?>;
                </script>
                <!-- Search form (end) -->
                <?php } ?>
                <?php if ($Page->ShowCurrentFilter) { ?>
                <?php $Page->showFilterList() ?>
                <?php } ?>
                <?php

// Set the last group to display if not export all
if ($Page->ExportAll && $Page->Export <> "") {
	$Page->StopGroup = $Page->TotalGroups;
} else {
	$Page->StopGroup = $Page->StartGroup + $Page->DisplayGroups - 1;
}

// Stop group <= total number of groups
if (intval($Page->StopGroup) > intval($Page->TotalGroups))
	$Page->StopGroup = $Page->TotalGroups;
$Page->RecordCount = 0;
$Page->RecordIndex = 0;

// Get first row
if ($Page->TotalGroups > 0) {
	$Page->loadGroupRowValues(TRUE);
	$Page->GroupCounter[0] = 1;
	$Page->GroupCounter[1] = 1;
	$Page->GroupCount = 1;
}
$Page->GroupIndexes = InitArray($Page->StopGroup - $Page->StartGroup + 1, -1);
while ($Page->GroupRecordset && !$Page->GroupRecordset->EOF && $Page->GroupCount <= $Page->DisplayGroups || $Page->ShowHeader) {

	// Show dummy header for custom template
	// Show header

	if ($Page->ShowHeader) {
?>
                <?php if ($Page->GroupCount > 1) { ?>
                </tbody>
                </table>
            </div>
            <?php if ($Page->Export == "" && !($Page->DrillDown && $Page->TotalGroups > 0)) { ?>
            <div class="card-footer ew-grid-lower-panel">
                <?php include "Product_Report__pager.php" ?>
                <div class="clearfix"></div>
            </div>
            <?php } ?>
        </div>
        <span
            data-class="tpb<?php echo $Page->GroupCount - 1 ?>_Product_Report_"><?php echo $Page->PageBreakContent ?></span>
        <?php } ?>
        <?php if ($Page->Export == "word" || $Page->Export == "excel") { ?>
        <div class="ew-grid" <?php echo $Page->ReportTableStyle ?>>
            <?php } else { ?>
            <div class="card ew-card ew-grid" <?php echo $Page->ReportTableStyle ?>>
                <?php } ?>
                <!-- Report grid (begin) -->
                <div id="gmp_Product_Report_"
                    class="<?php if (IsResponsiveLayout()) { echo "table-responsive "; } ?>ew-grid-middle-panel">
                    <table class="<?php echo $Page->ReportTableClass ?>">
                        <thead>
                            <!-- Table header -->
                            <tr class="ew-table-header">
                                <?php if ($Page->bussiness_name->Visible) { echo'<div style="margin-top:-2rem;"></div>
	<img src="logo.png" alt="gm" style="height: 90px;width: 170px;margin-bottom: -5.5rem;margin-left: 1rem;margin-top: 3rem;">
	<div style="margin-left: 15rem;">
	<p>
	<h1><b>GrowMore</b></h1>
	
	
	Email: Gromore@gmail.com 
	</p>
	<p style="margin-left: 40rem;margin-right: 5px;margin-top: -2rem;">Date: '.date('d-m-Y H:i:s'). '</p>
	</div>
	<hr class="bg-dark">
	<center><h2><u>Products Reports</u></h2></center>'; ?>
                                <?php if ($Page->bussiness_name->ShowGroupHeaderAsRow) { ?>
                                <td data-field="bussiness_name">&nbsp;</td>
                                <?php } else { ?>
                                <?php if ($Page->Export <> "" || $Page->DrillDown) { ?>
                                <td data-field="bussiness_name">
                                    <div class="Product_Report__bussiness_name"><span
                                            class="ew-table-header-caption"><?php echo $Page->bussiness_name->caption() ?></span>
                                    </div>
                                </td>
                                <?php } else { ?>
                                <td data-field="bussiness_name">
                                    <?php if ($Page->sortUrl($Page->bussiness_name) == "") { ?>
                                    <div class="ew-table-header-btn Product_Report__bussiness_name">
                                        <span
                                            class="ew-table-header-caption"><?php echo $Page->bussiness_name->caption() ?></span>
                                    </div>
                                    <?php } else { ?>
                                    <div class="ew-table-header-btn ew-pointer Product_Report__bussiness_name"
                                        onclick="ew.sort(event,'<?php echo $Page->sortUrl($Page->bussiness_name) ?>',0);">
                                        <span
                                            class="ew-table-header-caption"><?php echo $Page->bussiness_name->caption() ?></span>
                                        <span
                                            class="ew-table-header-sort"><?php if ($Page->bussiness_name->getSort() == "ASC") { ?><i
                                                class="fa fa-sort-up"></i><?php } elseif ($Page->bussiness_name->getSort() == "DESC") { ?><i
                                                class="fa fa-sort-down"></i><?php } ?></span>
                                    </div>
                                    <?php } ?>
                                </td>
                                <?php } ?>
                                <?php } ?>
                                <?php } ?>
                                <?php if ($Page->categoryname->Visible) { ?>
                                <?php if ($Page->categoryname->ShowGroupHeaderAsRow) { ?>
                                <td data-field="categoryname">&nbsp;</td>
                                <?php } else { ?>
                                <?php if ($Page->Export <> "" || $Page->DrillDown) { ?>
                                <td data-field="categoryname">
                                    <div class="Product_Report__categoryname"><span
                                            class="ew-table-header-caption"><?php echo $Page->categoryname->caption() ?></span>
                                    </div>
                                </td>
                                <?php } else { ?>
                                <td data-field="categoryname">
                                    <?php if ($Page->sortUrl($Page->categoryname) == "") { ?>
                                    <div class="ew-table-header-btn Product_Report__categoryname">
                                        <span
                                            class="ew-table-header-caption"><?php echo $Page->categoryname->caption() ?></span>
                                    </div>
                                    <?php } else { ?>
                                    <div class="ew-table-header-btn ew-pointer Product_Report__categoryname"
                                        onclick="ew.sort(event,'<?php echo $Page->sortUrl($Page->categoryname) ?>',0);">
                                        <span
                                            class="ew-table-header-caption"><?php echo $Page->categoryname->caption() ?></span>
                                        <span
                                            class="ew-table-header-sort"><?php if ($Page->categoryname->getSort() == "ASC") { ?><i
                                                class="fa fa-sort-up"></i><?php } elseif ($Page->categoryname->getSort() == "DESC") { ?><i
                                                class="fa fa-sort-down"></i><?php } ?></span>
                                    </div>
                                    <?php } ?>
                                </td>
                                <?php } ?>
                                <?php } ?>
                                <?php } ?>
                                <?php if ($Page->subcategoryname->Visible) { ?>
                                <?php if ($Page->subcategoryname->ShowGroupHeaderAsRow) { ?>
                                <td data-field="subcategoryname">&nbsp;</td>
                                <?php } else { ?>
                                <?php if ($Page->Export <> "" || $Page->DrillDown) { ?>
                                <td data-field="subcategoryname">
                                    <div class="Product_Report__subcategoryname"><span
                                            class="ew-table-header-caption"><?php echo $Page->subcategoryname->caption() ?></span>
                                    </div>
                                </td>
                                <?php } else { ?>
                                <td data-field="subcategoryname">
                                    <?php if ($Page->sortUrl($Page->subcategoryname) == "") { ?>
                                    <div class="ew-table-header-btn Product_Report__subcategoryname">
                                        <span
                                            class="ew-table-header-caption"><?php echo $Page->subcategoryname->caption() ?></span>
                                    </div>
                                    <?php } else { ?>
                                    <div class="ew-table-header-btn ew-pointer Product_Report__subcategoryname"
                                        onclick="ew.sort(event,'<?php echo $Page->sortUrl($Page->subcategoryname) ?>',0);">
                                        <span
                                            class="ew-table-header-caption"><?php echo $Page->subcategoryname->caption() ?></span>
                                        <span
                                            class="ew-table-header-sort"><?php if ($Page->subcategoryname->getSort() == "ASC") { ?><i
                                                class="fa fa-sort-up"></i><?php } elseif ($Page->subcategoryname->getSort() == "DESC") { ?><i
                                                class="fa fa-sort-down"></i><?php } ?></span>
                                    </div>
                                    <?php } ?>
                                </td>
                                <?php } ?>
                                <?php } ?>
                                <?php } ?>
                                <?php if ($Page->idproduct->Visible) { ?>
                                <?php if ($Page->Export <> "" || $Page->DrillDown) { ?>
                                <td data-field="idproduct">
                                    <div class="Product_Report__idproduct"><span
                                            class="ew-table-header-caption"><?php echo $Page->idproduct->caption() ?></span>
                                    </div>
                                </td>
                                <?php } else { ?>
                                <td data-field="idproduct">
                                    <?php if ($Page->sortUrl($Page->idproduct) == "") { ?>
                                    <div class="ew-table-header-btn Product_Report__idproduct">
                                        <span
                                            class="ew-table-header-caption"><?php echo $Page->idproduct->caption() ?></span>
                                    </div>
                                    <?php } else { ?>
                                    <div class="ew-table-header-btn ew-pointer Product_Report__idproduct"
                                        onclick="ew.sort(event,'<?php echo $Page->sortUrl($Page->idproduct) ?>',0);">
                                        <span
                                            class="ew-table-header-caption"><?php echo $Page->idproduct->caption() ?></span>
                                        <span
                                            class="ew-table-header-sort"><?php if ($Page->idproduct->getSort() == "ASC") { ?><i
                                                class="fa fa-sort-up"></i><?php } elseif ($Page->idproduct->getSort() == "DESC") { ?><i
                                                class="fa fa-sort-down"></i><?php } ?></span>
                                    </div>
                                    <?php } ?>
                                </td>
                                <?php } ?>
                                <?php } ?>
                                <?php if ($Page->pname->Visible) { ?>
                                <?php if ($Page->Export <> "" || $Page->DrillDown) { ?>
                                <td data-field="pname">
                                    <div class="Product_Report__pname"><span
                                            class="ew-table-header-caption"><?php echo $Page->pname->caption() ?></span>
                                    </div>
                                </td>
                                <?php } else { ?>
                                <td data-field="pname">
                                    <?php if ($Page->sortUrl($Page->pname) == "") { ?>
                                    <div class="ew-table-header-btn Product_Report__pname">
                                        <span
                                            class="ew-table-header-caption"><?php echo $Page->pname->caption() ?></span>
                                    </div>
                                    <?php } else { ?>
                                    <div class="ew-table-header-btn ew-pointer Product_Report__pname"
                                        onclick="ew.sort(event,'<?php echo $Page->sortUrl($Page->pname) ?>',0);">
                                        <span
                                            class="ew-table-header-caption"><?php echo $Page->pname->caption() ?></span>
                                        <span
                                            class="ew-table-header-sort"><?php if ($Page->pname->getSort() == "ASC") { ?><i
                                                class="fa fa-sort-up"></i><?php } elseif ($Page->pname->getSort() == "DESC") { ?><i
                                                class="fa fa-sort-down"></i><?php } ?></span>
                                    </div>
                                    <?php } ?>
                                </td>
                                <?php } ?>
                                <?php } ?>
                                <?php if ($Page->brand->Visible) { ?>
                                <?php if ($Page->Export <> "" || $Page->DrillDown) { ?>
                                <td data-field="brand">
                                    <div class="Product_Report__brand"><span
                                            class="ew-table-header-caption"><?php echo $Page->brand->caption() ?></span>
                                    </div>
                                </td>
                                <?php } else { ?>
                                <td data-field="brand">
                                    <?php if ($Page->sortUrl($Page->brand) == "") { ?>
                                    <div class="ew-table-header-btn Product_Report__brand">
                                        <span
                                            class="ew-table-header-caption"><?php echo $Page->brand->caption() ?></span>
                                    </div>
                                    <?php } else { ?>
                                    <div class="ew-table-header-btn ew-pointer Product_Report__brand"
                                        onclick="ew.sort(event,'<?php echo $Page->sortUrl($Page->brand) ?>',0);">
                                        <span
                                            class="ew-table-header-caption"><?php echo $Page->brand->caption() ?></span>
                                        <span
                                            class="ew-table-header-sort"><?php if ($Page->brand->getSort() == "ASC") { ?><i
                                                class="fa fa-sort-up"></i><?php } elseif ($Page->brand->getSort() == "DESC") { ?><i
                                                class="fa fa-sort-down"></i><?php } ?></span>
                                    </div>
                                    <?php } ?>
                                </td>
                                <?php } ?>
                                <?php } ?>
                                <?php if ($Page->MRP->Visible) { ?>
                                <?php if ($Page->Export <> "" || $Page->DrillDown) { ?>
                                <td data-field="MRP">
                                    <div class="Product_Report__MRP"><span
                                            class="ew-table-header-caption"><?php echo $Page->MRP->caption() ?></span>
                                    </div>
                                </td>
                                <?php } else { ?>
                                <td data-field="MRP">
                                    <?php if ($Page->sortUrl($Page->MRP) == "") { ?>
                                    <div class="ew-table-header-btn Product_Report__MRP">
                                        <span class="ew-table-header-caption"><?php echo $Page->MRP->caption() ?></span>
                                    </div>
                                    <?php } else { ?>
                                    <div class="ew-table-header-btn ew-pointer Product_Report__MRP"
                                        onclick="ew.sort(event,'<?php echo $Page->sortUrl($Page->MRP) ?>',0);">
                                        <span class="ew-table-header-caption"><?php echo $Page->MRP->caption() ?></span>
                                        <span
                                            class="ew-table-header-sort"><?php if ($Page->MRP->getSort() == "ASC") { ?><i
                                                class="fa fa-sort-up"></i><?php } elseif ($Page->MRP->getSort() == "DESC") { ?><i
                                                class="fa fa-sort-down"></i><?php } ?></span>
                                    </div>
                                    <?php } ?>
                                </td>
                                <?php } ?>
                                <?php } ?>
                                <?php if ($Page->price->Visible) { ?>
                                <?php if ($Page->Export <> "" || $Page->DrillDown) { ?>
                                <td data-field="price">
                                    <div class="Product_Report__price"><span
                                            class="ew-table-header-caption"><?php echo $Page->price->caption() ?></span>
                                    </div>
                                </td>
                                <?php } else { ?>
                                <td data-field="price">
                                    <?php if ($Page->sortUrl($Page->price) == "") { ?>
                                    <div class="ew-table-header-btn Product_Report__price">
                                        <span
                                            class="ew-table-header-caption"><?php echo $Page->price->caption() ?></span>
                                    </div>
                                    <?php } else { ?>
                                    <div class="ew-table-header-btn ew-pointer Product_Report__price"
                                        onclick="ew.sort(event,'<?php echo $Page->sortUrl($Page->price) ?>',0);">
                                        <span
                                            class="ew-table-header-caption"><?php echo $Page->price->caption() ?></span>
                                        <span
                                            class="ew-table-header-sort"><?php if ($Page->price->getSort() == "ASC") { ?><i
                                                class="fa fa-sort-up"></i><?php } elseif ($Page->price->getSort() == "DESC") { ?><i
                                                class="fa fa-sort-down"></i><?php } ?></span>
                                    </div>
                                    <?php } ?>
                                </td>
                                <?php } ?>
                                <?php } ?>
                                <?php if ($Page->description->Visible) { ?>
                                <?php if ($Page->Export <> "" || $Page->DrillDown) { ?>
                                <td data-field="description">
                                    <div class="Product_Report__description"><span
                                            class="ew-table-header-caption"><?php echo $Page->description->caption() ?></span>
                                    </div>
                                </td>
                                <?php } else { ?>
                                <td data-field="description">
                                    <?php if ($Page->sortUrl($Page->description) == "") { ?>
                                    <div class="ew-table-header-btn Product_Report__description">
                                        <span
                                            class="ew-table-header-caption"><?php echo $Page->description->caption() ?></span>
                                    </div>
                                    <?php } else { ?>
                                    <div class="ew-table-header-btn ew-pointer Product_Report__description"
                                        onclick="ew.sort(event,'<?php echo $Page->sortUrl($Page->description) ?>',0);">
                                        <span
                                            class="ew-table-header-caption"><?php echo $Page->description->caption() ?></span>
                                        <span
                                            class="ew-table-header-sort"><?php if ($Page->description->getSort() == "ASC") { ?><i
                                                class="fa fa-sort-up"></i><?php } elseif ($Page->description->getSort() == "DESC") { ?><i
                                                class="fa fa-sort-down"></i><?php } ?></span>
                                    </div>
                                    <?php } ?>
                                </td>
                                <?php } ?>
                                <?php } ?>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
		if ($Page->TotalGroups == 0) break; // Show header only
		$Page->ShowHeader = FALSE;
	}

	// Build detail SQL
	$where = DetailFilterSql($Page->bussiness_name, $Page->getSqlFirstGroupField(), $Page->bussiness_name->groupValue(), $Page->Dbid);
	if ($Page->PageFirstGroupFilter <> "") $Page->PageFirstGroupFilter .= " OR ";
	$Page->PageFirstGroupFilter .= $where;
	if ($Page->Filter != "")
		$where = "($Page->Filter) AND ($where)";
	$sql = BuildReportSql($Page->getSqlSelect(), $Page->getSqlWhere(), $Page->getSqlGroupBy(), $Page->getSqlHaving(), $Page->getSqlOrderBy(), $where, $Page->Sort);
	$Page->DetailRecordCount = 0;
	if ($Page->Recordset = $Page->getRecordset($sql)) {
		$Page->DetailRecordCount = $Page->Recordset->recordCount();
		if (GetConnectionType($Page->Dbid) == "ORACLE") { // Oracle, cannot moveFirst, use another recordset
			$rswrk = $Page->getRecordset($sql);
			$Page->DetailRows = $rswrk ? $rswrk->getRows() : [];
			$rswrk->close();
		} else {
			$Page->DetailRows = $Page->Recordset ? $Page->Recordset->getRows() : [];
		}
	}
	if ($Page->DetailRecordCount > 0)
		$Page->loadRowValues(TRUE);
	$Page->GroupIndexes[$Page->GroupCount] = [-1];
	$Page->GroupIndexes[$Page->GroupCount][] = [-1];
	while ($Page->Recordset && !$Page->Recordset->EOF) { // Loop detail records
		$Page->RecordCount++;
		$Page->RecordIndex++;
?>
                            <?php if ($Page->bussiness_name->Visible && $Page->checkLevelBreak(1) && $Page->bussiness_name->ShowGroupHeaderAsRow) { ?>
                            <?php

		// Render header row
		$Page->resetAttributes();
		$Page->RowType = ROWTYPE_TOTAL;
		$Page->RowTotalType = ROWTOTAL_GROUP;
		$Page->RowTotalSubType = ROWTOTAL_HEADER;
		$Page->RowGroupLevel = 1;
		$Page->bussiness_name->Count = $Page->getSummaryCount(1);
		$Page->renderRow();
?>
                            <tr<?php echo $Page->rowAttributes(); ?>>
                                <?php if ($Page->bussiness_name->Visible) { ?>
                                <td data-field="bussiness_name" <?php echo $Page->bussiness_name->cellAttributes(); ?>>
                                    <span class="ew-group-toggle icon-collapse"></span></td>
                                <?php } ?>
                                <td data-field="bussiness_name"
                                    colspan="<?php echo ($Page->GroupColumnCount + $Page->DetailColumnCount - 1) ?>"
                                    <?php echo $Page->bussiness_name->cellAttributes() ?>>
                                    <?php if ($Page->Export <> "" || $Page->DrillDown) { ?>
                                    <span class="ew-summary-caption Product_Report__bussiness_name"><span
                                            class="ew-table-header-caption"><?php echo $Page->bussiness_name->caption() ?></span></span>
                                    <?php } else { ?>
                                    <?php if ($Page->sortUrl($Page->bussiness_name) == "") { ?>
                                    <span class="ew-summary-caption Product_Report__bussiness_name">
                                        <span
                                            class="ew-table-header-caption"><?php echo $Page->bussiness_name->caption() ?></span>
                                    </span>
                                    <?php } else { ?>
                                    <span
                                        class="ew-table-header-btn ew-pointer ew-summary-caption Product_Report__bussiness_name"
                                        onclick="ew.sort(event,'<?php echo $Page->sortUrl($Page->bussiness_name) ?>',0);">
                                        <span
                                            class="ew-table-header-caption"><?php echo $Page->bussiness_name->caption() ?></span>
                                        <span
                                            class="ew-table-header-sort"><?php if ($Page->bussiness_name->getSort() == "ASC") { ?><i
                                                class="fa fa-sort-up"></i><?php } elseif ($Page->bussiness_name->getSort() == "DESC") { ?><i
                                                class="fa fa-sort-down"></i><?php } ?></span>
                                    </span>
                                    <?php } ?>
                                    <?php } ?>
                                    <?php echo $ReportLanguage->phrase("SummaryColon") ?>
                                    <span data-class="tpx<?php echo $Page->GroupCount ?>_Product_Report__bussiness_name"
                                        <?php echo $Page->bussiness_name->viewAttributes() ?>><?php echo $Page->bussiness_name->GroupViewValue ?></span>
                                    <span class="ew-summary-count">(<span
                                            class="ew-aggregate-caption"><?php echo $ReportLanguage->phrase("RptCnt") ?></span><?php echo $ReportLanguage->phrase("AggregateEqual") ?><span
                                            class="ew-aggregate-value"><?php echo FormatNumber($Page->bussiness_name->Count,0,-2,-2,-2) ?></span>)</span>
                                </td>
                                </tr>
                                <?php } ?>
                                <?php if ($Page->categoryname->Visible && $Page->checkLevelBreak(2) && $Page->categoryname->ShowGroupHeaderAsRow) { ?>
                                <?php

		// Render header row
		$Page->resetAttributes();
		$Page->RowType = ROWTYPE_TOTAL;
		$Page->RowTotalType = ROWTOTAL_GROUP;
		$Page->RowTotalSubType = ROWTOTAL_HEADER;
		$Page->RowGroupLevel = 2;
		$Page->categoryname->Count = $Page->getSummaryCount(2);
		$Page->renderRow();
?>
                                <tr<?php echo $Page->rowAttributes(); ?>>
                                    <?php if ($Page->bussiness_name->Visible) { ?>
                                    <td data-field="bussiness_name"
                                        <?php echo $Page->bussiness_name->cellAttributes(); ?>></td>
                                    <?php } ?>
                                    <?php if ($Page->categoryname->Visible) { ?>
                                    <td data-field="categoryname" <?php echo $Page->categoryname->cellAttributes(); ?>>
                                        <span class="ew-group-toggle icon-collapse"></span></td>
                                    <?php } ?>
                                    <td data-field="categoryname"
                                        colspan="<?php echo ($Page->GroupColumnCount + $Page->DetailColumnCount - 2) ?>"
                                        <?php echo $Page->categoryname->cellAttributes() ?>>
                                        <?php if ($Page->Export <> "" || $Page->DrillDown) { ?>
                                        <span class="ew-summary-caption Product_Report__categoryname"><span
                                                class="ew-table-header-caption"><?php echo $Page->categoryname->caption() ?></span></span>
                                        <?php } else { ?>
                                        <?php if ($Page->sortUrl($Page->categoryname) == "") { ?>
                                        <span class="ew-summary-caption Product_Report__categoryname">
                                            <span
                                                class="ew-table-header-caption"><?php echo $Page->categoryname->caption() ?></span>
                                        </span>
                                        <?php } else { ?>
                                        <span
                                            class="ew-table-header-btn ew-pointer ew-summary-caption Product_Report__categoryname"
                                            onclick="ew.sort(event,'<?php echo $Page->sortUrl($Page->categoryname) ?>',0);">
                                            <span
                                                class="ew-table-header-caption"><?php echo $Page->categoryname->caption() ?></span>
                                            <span
                                                class="ew-table-header-sort"><?php if ($Page->categoryname->getSort() == "ASC") { ?><i
                                                    class="fa fa-sort-up"></i><?php } elseif ($Page->categoryname->getSort() == "DESC") { ?><i
                                                    class="fa fa-sort-down"></i><?php } ?></span>
                                        </span>
                                        <?php } ?>
                                        <?php } ?>
                                        <?php echo $ReportLanguage->phrase("SummaryColon") ?>
                                        <span
                                            data-class="tpx<?php echo $Page->GroupCount ?>_<?php echo $Page->GroupCounter[0] ?>_Product_Report__categoryname"
                                            <?php echo $Page->categoryname->viewAttributes() ?>><?php echo $Page->categoryname->GroupViewValue ?></span>
                                        <span class="ew-summary-count">(<span
                                                class="ew-aggregate-caption"><?php echo $ReportLanguage->phrase("RptCnt") ?></span><?php echo $ReportLanguage->phrase("AggregateEqual") ?><span
                                                class="ew-aggregate-value"><?php echo FormatNumber($Page->categoryname->Count,0,-2,-2,-2) ?></span>)</span>
                                    </td>
                                    </tr>
                                    <?php } ?>
                                    <?php if ($Page->subcategoryname->Visible && $Page->checkLevelBreak(3) && $Page->subcategoryname->ShowGroupHeaderAsRow) { ?>
                                    <?php

		// Render header row
		$Page->resetAttributes();
		$Page->RowType = ROWTYPE_TOTAL;
		$Page->RowTotalType = ROWTOTAL_GROUP;
		$Page->RowTotalSubType = ROWTOTAL_HEADER;
		$Page->RowGroupLevel = 3;
		$Page->subcategoryname->Count = $Page->getSummaryCount(3);
		$Page->renderRow();
?>
                                    <tr<?php echo $Page->rowAttributes(); ?>>
                                        <?php if ($Page->bussiness_name->Visible) { ?>
                                        <td data-field="bussiness_name"
                                            <?php echo $Page->bussiness_name->cellAttributes(); ?>></td>
                                        <?php } ?>
                                        <?php if ($Page->categoryname->Visible) { ?>
                                        <td data-field="categoryname"
                                            <?php echo $Page->categoryname->cellAttributes(); ?>></td>
                                        <?php } ?>
                                        <?php if ($Page->subcategoryname->Visible) { ?>
                                        <td data-field="subcategoryname"
                                            <?php echo $Page->subcategoryname->cellAttributes(); ?>><span
                                                class="ew-group-toggle icon-collapse"></span></td>
                                        <?php } ?>
                                        <td data-field="subcategoryname"
                                            colspan="<?php echo ($Page->GroupColumnCount + $Page->DetailColumnCount - 3) ?>"
                                            <?php echo $Page->subcategoryname->cellAttributes() ?>>
                                            <?php if ($Page->Export <> "" || $Page->DrillDown) { ?>
                                            <span class="ew-summary-caption Product_Report__subcategoryname"><span
                                                    class="ew-table-header-caption"><?php echo $Page->subcategoryname->caption() ?></span></span>
                                            <?php } else { ?>
                                            <?php if ($Page->sortUrl($Page->subcategoryname) == "") { ?>
                                            <span class="ew-summary-caption Product_Report__subcategoryname">
                                                <span
                                                    class="ew-table-header-caption"><?php echo $Page->subcategoryname->caption() ?></span>
                                            </span>
                                            <?php } else { ?>
                                            <span
                                                class="ew-table-header-btn ew-pointer ew-summary-caption Product_Report__subcategoryname"
                                                onclick="ew.sort(event,'<?php echo $Page->sortUrl($Page->subcategoryname) ?>',0);">
                                                <span
                                                    class="ew-table-header-caption"><?php echo $Page->subcategoryname->caption() ?></span>
                                                <span
                                                    class="ew-table-header-sort"><?php if ($Page->subcategoryname->getSort() == "ASC") { ?><i
                                                        class="fa fa-sort-up"></i><?php } elseif ($Page->subcategoryname->getSort() == "DESC") { ?><i
                                                        class="fa fa-sort-down"></i><?php } ?></span>
                                            </span>
                                            <?php } ?>
                                            <?php } ?>
                                            <?php echo $ReportLanguage->phrase("SummaryColon") ?>
                                            <span
                                                data-class="tpx<?php echo $Page->GroupCount ?>_<?php echo $Page->GroupCounter[0] ?>_<?php echo $Page->GroupCounter[1] ?>_Product_Report__subcategoryname"
                                                <?php echo $Page->subcategoryname->viewAttributes() ?>><?php echo $Page->subcategoryname->GroupViewValue ?></span>
                                            <span class="ew-summary-count">(<span
                                                    class="ew-aggregate-caption"><?php echo $ReportLanguage->phrase("RptCnt") ?></span><?php echo $ReportLanguage->phrase("AggregateEqual") ?><span
                                                    class="ew-aggregate-value"><?php echo FormatNumber($Page->subcategoryname->Count,0,-2,-2,-2) ?></span>)</span>
                                        </td>
                                        </tr>
                                        <?php } ?>
                                        <?php

		// Render detail row
		$Page->resetAttributes();
		$Page->RowType = ROWTYPE_DETAIL;
		$Page->renderRow();
?>
                                        <tr<?php echo $Page->rowAttributes(); ?>>
                                            <?php if ($Page->bussiness_name->Visible) { ?>
                                            <?php if ($Page->bussiness_name->ShowGroupHeaderAsRow) { ?>
                                            <td data-field="bussiness_name"
                                                <?php echo $Page->bussiness_name->cellAttributes(); ?>>&nbsp;</td>
                                            <?php } else { ?>
                                            <td data-field="bussiness_name"
                                                <?php echo $Page->bussiness_name->cellAttributes(); ?>>
                                                <span
                                                    data-class="tpx<?php echo $Page->GroupCount ?>_Product_Report__bussiness_name"
                                                    <?php echo $Page->bussiness_name->viewAttributes() ?>><?php echo $Page->bussiness_name->GroupViewValue ?></span>
                                            </td>
                                            <?php } ?>
                                            <?php } ?>
                                            <?php if ($Page->categoryname->Visible) { ?>
                                            <?php if ($Page->categoryname->ShowGroupHeaderAsRow) { ?>
                                            <td data-field="categoryname"
                                                <?php echo $Page->categoryname->cellAttributes(); ?>>&nbsp;</td>
                                            <?php } else { ?>
                                            <td data-field="categoryname"
                                                <?php echo $Page->categoryname->cellAttributes(); ?>>
                                                <span
                                                    data-class="tpx<?php echo $Page->GroupCount ?>_<?php echo $Page->GroupCounter[0] ?>_Product_Report__categoryname"
                                                    <?php echo $Page->categoryname->viewAttributes() ?>><?php echo $Page->categoryname->GroupViewValue ?></span>
                                            </td>
                                            <?php } ?>
                                            <?php } ?>
                                            <?php if ($Page->subcategoryname->Visible) { ?>
                                            <?php if ($Page->subcategoryname->ShowGroupHeaderAsRow) { ?>
                                            <td data-field="subcategoryname"
                                                <?php echo $Page->subcategoryname->cellAttributes(); ?>>&nbsp;</td>
                                            <?php } else { ?>
                                            <td data-field="subcategoryname"
                                                <?php echo $Page->subcategoryname->cellAttributes(); ?>>
                                                <span
                                                    data-class="tpx<?php echo $Page->GroupCount ?>_<?php echo $Page->GroupCounter[0] ?>_<?php echo $Page->GroupCounter[1] ?>_Product_Report__subcategoryname"
                                                    <?php echo $Page->subcategoryname->viewAttributes() ?>><?php echo $Page->subcategoryname->GroupViewValue ?></span>
                                            </td>
                                            <?php } ?>
                                            <?php } ?>
                                            <?php if ($Page->idproduct->Visible) { ?>
                                            <td data-field="idproduct" <?php echo $Page->idproduct->cellAttributes() ?>>
                                                <span<?php echo $Page->idproduct->viewAttributes() ?>>
                                                    <?php echo $Page->idproduct->getViewValue() ?></span>
                                            </td>
                                            <?php } ?>
                                            <?php if ($Page->pname->Visible) { ?>
                                            <td data-field="pname" <?php echo $Page->pname->cellAttributes() ?>>
                                                <span<?php echo $Page->pname->viewAttributes() ?>>
                                                    <?php echo $Page->pname->getViewValue() ?></span>
                                            </td>
                                            <?php } ?>
                                            <?php if ($Page->brand->Visible) { ?>
                                            <td data-field="brand" <?php echo $Page->brand->cellAttributes() ?>>
                                                <span<?php echo $Page->brand->viewAttributes() ?>>
                                                    <?php echo $Page->brand->getViewValue() ?></span>
                                            </td>
                                            <?php } ?>
                                            <?php if ($Page->MRP->Visible) { ?>
                                            <td data-field="MRP" <?php echo $Page->MRP->cellAttributes() ?>>
                                                <span<?php echo $Page->MRP->viewAttributes() ?>>
                                                    <?php echo $Page->MRP->getViewValue() ?></span>
                                            </td>
                                            <?php } ?>
                                            <?php if ($Page->price->Visible) { ?>
                                            <td data-field="price" <?php echo $Page->price->cellAttributes() ?>>
                                                <span<?php echo $Page->price->viewAttributes() ?>>
                                                    <?php echo $Page->price->getViewValue() ?></span>
                                            </td>
                                            <?php } ?>
                                            <?php if ($Page->description->Visible) { ?>
                                            <td data-field="description"
                                                <?php echo $Page->description->cellAttributes() ?>>
                                                <span<?php echo $Page->description->viewAttributes() ?>>
                                                    <?php echo $Page->description->getViewValue() ?></span>
                                            </td>
                                            <?php } ?>
                                            </tr>
                                            <?php

		// Accumulate page summary
		$Page->accumulateSummary();

		// Get next record
		$Page->loadRowValues();

		// Show Footers
?>
                                            <?php
	} // End detail records loop
?>
                                            <?php

	// Next group
	$Page->loadGroupRowValues();

	// Show header if page break
	if ($Page->Export <> "")
		$Page->ShowHeader = ($Page->ExportPageBreakCount == 0) ? FALSE : ($Page->GroupCount % $Page->ExportPageBreakCount == 0);

	// Page_Breaking server event
	if ($Page->ShowHeader)
		$Page->Page_Breaking($Page->ShowHeader, $Page->PageBreakContent);
	$Page->GroupCount++;
	$Page->GroupCounter[1] = 1;
	$Page->GroupCounter[0] = 1;

	// Handle EOF
	if (!$Page->GroupRecordset || $Page->GroupRecordset->EOF)
		$Page->ShowHeader = FALSE;
} // End while
?>
                                            <?php if ($Page->TotalGroups > 0) { ?>
                        </tbody>
                        <tfoot>
                            <?php
	$Page->resetAttributes();
	$Page->RowType = ROWTYPE_TOTAL;
	$Page->RowTotalType = ROWTOTAL_GRAND;
	$Page->RowTotalSubType = ROWTOTAL_FOOTER;
	$Page->RowAttrs["class"] = "ew-rpt-grand-summary";
	$Page->renderRow();
?>
                            <?php if ($Page->subcategoryname->ShowCompactSummaryFooter) { ?>
                            <tr<?php echo $Page->rowAttributes() ?>>
                                <td colspan="<?php echo ($Page->GroupColumnCount + $Page->DetailColumnCount) ?>">
                                    <?php echo $ReportLanguage->Phrase("RptGrandSummary") ?> <span
                                        class="ew-summary-count">(<span
                                            class="ew-aggregate-caption"><?php echo $ReportLanguage->phrase("RptCnt") ?></span><?php echo $ReportLanguage->phrase("AggregateEqual") ?><span
                                            class="ew-aggregate-value"><?php echo FormatNumber($Page->TotalCount,0,-2,-2,-2) ?></span>)</span>
                                </td>
                                </tr>
                                <?php } else { ?>
                                <tr<?php echo $Page->rowAttributes() ?>>
                                    <td colspan="<?php echo ($Page->GroupColumnCount + $Page->DetailColumnCount) ?>">
                                        <?php echo $ReportLanguage->Phrase("RptGrandSummary") ?> <span
                                            class="ew-summary-count">(<?php echo FormatNumber($Page->TotalCount,0,-2,-2,-2); ?><?php echo $ReportLanguage->Phrase("RptDtlRec") ?>)</span>
                                    </td>
                                    </tr>
                                    <?php } ?>
                        </tfoot>
                        <?php } elseif (!$Page->ShowHeader && FALSE) { // No header displayed ?>
                        <?php if ($Page->Export == "word" || $Page->Export == "excel") { ?>
                        <div class="ew-grid" <?php echo $Page->ReportTableStyle ?>>
                            <?php } else { ?>
                            <div class="card ew-card ew-grid" <?php echo $Page->ReportTableStyle ?>>
                                <?php } ?>
                                <!-- Report grid (begin) -->
                                <div id="gmp_Product_Report_"
                                    class="<?php if (IsResponsiveLayout()) { echo "table-responsive "; } ?>ew-grid-middle-panel">
                                    <table class="<?php echo $Page->ReportTableClass ?>">
                                        <?php } ?>
                                        <?php if ($Page->TotalGroups > 0 || FALSE) { // Show footer ?>
                                    </table>
                                </div>
                                <?php if ($Page->Export == "" && !($Page->DrillDown && $Page->TotalGroups > 0)) { ?>
                                <div class="card-footer ew-grid-lower-panel">
                                    <?php include "Product_Report__pager.php" ?>
                                    <div class="clearfix"></div>
                                </div>
                                <?php } ?>
                            </div>
                            <?php } ?>
                        </div>
                        <!-- Summary Report Ends -->
                        <?php if ($Page->Export == "" && !$DashboardReport) { ?>
                </div>
                <!-- /#ew-center -->
                <?php } ?>
                <?php if ($Page->Export == "" && !$DashboardReport) { ?>
            </div>
            <!-- /.row -->
            <?php } ?>
            <?php if ($Page->Export == "" && !$DashboardReport) { ?>
        </div>
        <!-- /.ew-container -->
        <?php } ?>
        <?php
$Page->showPageFooter();
if (DEBUG_ENABLED)
	echo GetDebugMessage();
?>
        <?php

// Close recordsets
if ($Page->GroupRecordset)
	$Page->GroupRecordset->Close();
if ($Page->Recordset)
	$Page->Recordset->Close();
?>
        <?php if ($Page->Export == "" && !$Page->DrillDown && !$DashboardReport) { ?>
        <script>
        // Write your table-specific startup script here
        // console.log("page loaded");
        </script>
        <?php } ?>
        <?php if (!$DashboardReport) { ?>
        <?php include_once "rfooter.php" ?>
        <?php } ?>
        <?php
$Page->terminate();
if (isset($OldPage))
	$Page = $OldPage;
?>