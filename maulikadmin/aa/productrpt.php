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
if (!isset($product_rpt))
	$product_rpt = new product_rpt();
if (isset($Page))
	$OldPage = $Page;
$Page = &$product_rpt;

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
currentPageID = ew.PAGE_ID = "rpt"; // Page ID
</script>
<?php } ?>
<?php if ($Page->Export == "" && !$Page->DrillDown && !$DashboardReport) { ?>
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
<div id="ew-center" class="<?php echo $product_rpt->CenterContentClass ?>">
<?php } ?>
<!-- Summary Report begins -->
<?php if ($Page->Export <> "pdf") { ?>
<div id="report_summary">
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
	$Page->loadRowValues(TRUE);
	$Page->GroupCount = 1;
}
$Page->GroupIndexes = InitArray(2, -1);
$Page->GroupIndexes[0] = -1;
$Page->GroupIndexes[1] = $Page->StopGroup - $Page->StartGroup + 1;
while ($Page->Recordset && !$Page->Recordset->EOF && $Page->GroupCount <= $Page->DisplayGroups || $Page->ShowHeader) {

	// Show dummy header for custom template
	// Show header

	if ($Page->ShowHeader) {
?>
<?php if ($Page->Export <> "pdf") { ?>
<?php if ($Page->Export == "word" || $Page->Export == "excel") { ?>
<div class="ew-grid"<?php echo $Page->ReportTableStyle ?>>
<?php } else { ?>
<div class="card ew-card ew-grid"<?php echo $Page->ReportTableStyle ?>>
<?php } ?>
<?php } ?>
<!-- Report grid (begin) -->
<?php if ($Page->Export <> "pdf") { ?>
<div id="gmp_product" class="<?php if (IsResponsiveLayout()) { echo "table-responsive "; } ?>ew-grid-middle-panel">
<?php } ?>
<table class="<?php echo $Page->ReportTableClass ?>">
<thead>
	<!-- Table header -->
	<tr class="ew-table-header">
<?php if ($Page->idproduct->Visible) { ?>
<?php if ($Page->Export <> "" || $Page->DrillDown) { ?>
	<td data-field="idproduct"><div class="product_idproduct"><span class="ew-table-header-caption"><?php echo $Page->idproduct->caption() ?></span></div></td>
<?php } else { ?>
	<td data-field="idproduct">
<?php if ($Page->sortUrl($Page->idproduct) == "") { ?>
		<div class="ew-table-header-btn product_idproduct">
			<span class="ew-table-header-caption"><?php echo $Page->idproduct->caption() ?></span>
		</div>
<?php } else { ?>
		<div class="ew-table-header-btn ew-pointer product_idproduct" onclick="ew.sort(event,'<?php echo $Page->sortUrl($Page->idproduct) ?>',0);">
			<span class="ew-table-header-caption"><?php echo $Page->idproduct->caption() ?></span>
			<span class="ew-table-header-sort"><?php if ($Page->idproduct->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($Page->idproduct->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span>
		</div>
<?php } ?>
	</td>
<?php } ?>
<?php } ?>
<?php if ($Page->pname->Visible) { ?>
<?php if ($Page->Export <> "" || $Page->DrillDown) { ?>
	<td data-field="pname"><div class="product_pname"><span class="ew-table-header-caption"><?php echo $Page->pname->caption() ?></span></div></td>
<?php } else { ?>
	<td data-field="pname">
<?php if ($Page->sortUrl($Page->pname) == "") { ?>
		<div class="ew-table-header-btn product_pname">
			<span class="ew-table-header-caption"><?php echo $Page->pname->caption() ?></span>
		</div>
<?php } else { ?>
		<div class="ew-table-header-btn ew-pointer product_pname" onclick="ew.sort(event,'<?php echo $Page->sortUrl($Page->pname) ?>',0);">
			<span class="ew-table-header-caption"><?php echo $Page->pname->caption() ?></span>
			<span class="ew-table-header-sort"><?php if ($Page->pname->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($Page->pname->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span>
		</div>
<?php } ?>
	</td>
<?php } ?>
<?php } ?>
<?php if ($Page->brand->Visible) { ?>
<?php if ($Page->Export <> "" || $Page->DrillDown) { ?>
	<td data-field="brand"><div class="product_brand"><span class="ew-table-header-caption"><?php echo $Page->brand->caption() ?></span></div></td>
<?php } else { ?>
	<td data-field="brand">
<?php if ($Page->sortUrl($Page->brand) == "") { ?>
		<div class="ew-table-header-btn product_brand">
			<span class="ew-table-header-caption"><?php echo $Page->brand->caption() ?></span>
		</div>
<?php } else { ?>
		<div class="ew-table-header-btn ew-pointer product_brand" onclick="ew.sort(event,'<?php echo $Page->sortUrl($Page->brand) ?>',0);">
			<span class="ew-table-header-caption"><?php echo $Page->brand->caption() ?></span>
			<span class="ew-table-header-sort"><?php if ($Page->brand->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($Page->brand->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span>
		</div>
<?php } ?>
	</td>
<?php } ?>
<?php } ?>
<?php if ($Page->minimum_set_qut_pur->Visible) { ?>
<?php if ($Page->Export <> "" || $Page->DrillDown) { ?>
	<td data-field="minimum_set_qut_pur"><div class="product_minimum_set_qut_pur"><span class="ew-table-header-caption"><?php echo $Page->minimum_set_qut_pur->caption() ?></span></div></td>
<?php } else { ?>
	<td data-field="minimum_set_qut_pur">
<?php if ($Page->sortUrl($Page->minimum_set_qut_pur) == "") { ?>
		<div class="ew-table-header-btn product_minimum_set_qut_pur">
			<span class="ew-table-header-caption"><?php echo $Page->minimum_set_qut_pur->caption() ?></span>
		</div>
<?php } else { ?>
		<div class="ew-table-header-btn ew-pointer product_minimum_set_qut_pur" onclick="ew.sort(event,'<?php echo $Page->sortUrl($Page->minimum_set_qut_pur) ?>',0);">
			<span class="ew-table-header-caption"><?php echo $Page->minimum_set_qut_pur->caption() ?></span>
			<span class="ew-table-header-sort"><?php if ($Page->minimum_set_qut_pur->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($Page->minimum_set_qut_pur->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span>
		</div>
<?php } ?>
	</td>
<?php } ?>
<?php } ?>
<?php if ($Page->quantity_of_1_set->Visible) { ?>
<?php if ($Page->Export <> "" || $Page->DrillDown) { ?>
	<td data-field="quantity_of_1_set"><div class="product_quantity_of_1_set"><span class="ew-table-header-caption"><?php echo $Page->quantity_of_1_set->caption() ?></span></div></td>
<?php } else { ?>
	<td data-field="quantity_of_1_set">
<?php if ($Page->sortUrl($Page->quantity_of_1_set) == "") { ?>
		<div class="ew-table-header-btn product_quantity_of_1_set">
			<span class="ew-table-header-caption"><?php echo $Page->quantity_of_1_set->caption() ?></span>
		</div>
<?php } else { ?>
		<div class="ew-table-header-btn ew-pointer product_quantity_of_1_set" onclick="ew.sort(event,'<?php echo $Page->sortUrl($Page->quantity_of_1_set) ?>',0);">
			<span class="ew-table-header-caption"><?php echo $Page->quantity_of_1_set->caption() ?></span>
			<span class="ew-table-header-sort"><?php if ($Page->quantity_of_1_set->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($Page->quantity_of_1_set->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span>
		</div>
<?php } ?>
	</td>
<?php } ?>
<?php } ?>
<?php if ($Page->MRP->Visible) { ?>
<?php if ($Page->Export <> "" || $Page->DrillDown) { ?>
	<td data-field="MRP"><div class="product_MRP"><span class="ew-table-header-caption"><?php echo $Page->MRP->caption() ?></span></div></td>
<?php } else { ?>
	<td data-field="MRP">
<?php if ($Page->sortUrl($Page->MRP) == "") { ?>
		<div class="ew-table-header-btn product_MRP">
			<span class="ew-table-header-caption"><?php echo $Page->MRP->caption() ?></span>
		</div>
<?php } else { ?>
		<div class="ew-table-header-btn ew-pointer product_MRP" onclick="ew.sort(event,'<?php echo $Page->sortUrl($Page->MRP) ?>',0);">
			<span class="ew-table-header-caption"><?php echo $Page->MRP->caption() ?></span>
			<span class="ew-table-header-sort"><?php if ($Page->MRP->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($Page->MRP->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span>
		</div>
<?php } ?>
	</td>
<?php } ?>
<?php } ?>
<?php if ($Page->price->Visible) { ?>
<?php if ($Page->Export <> "" || $Page->DrillDown) { ?>
	<td data-field="price"><div class="product_price"><span class="ew-table-header-caption"><?php echo $Page->price->caption() ?></span></div></td>
<?php } else { ?>
	<td data-field="price">
<?php if ($Page->sortUrl($Page->price) == "") { ?>
		<div class="ew-table-header-btn product_price">
			<span class="ew-table-header-caption"><?php echo $Page->price->caption() ?></span>
		</div>
<?php } else { ?>
		<div class="ew-table-header-btn ew-pointer product_price" onclick="ew.sort(event,'<?php echo $Page->sortUrl($Page->price) ?>',0);">
			<span class="ew-table-header-caption"><?php echo $Page->price->caption() ?></span>
			<span class="ew-table-header-sort"><?php if ($Page->price->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($Page->price->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span>
		</div>
<?php } ?>
	</td>
<?php } ?>
<?php } ?>
<?php if ($Page->image->Visible) { ?>
<?php if ($Page->Export <> "" || $Page->DrillDown) { ?>
	<td data-field="image"><div class="product_image"><span class="ew-table-header-caption"><?php echo $Page->image->caption() ?></span></div></td>
<?php } else { ?>
	<td data-field="image">
<?php if ($Page->sortUrl($Page->image) == "") { ?>
		<div class="ew-table-header-btn product_image">
			<span class="ew-table-header-caption"><?php echo $Page->image->caption() ?></span>
		</div>
<?php } else { ?>
		<div class="ew-table-header-btn ew-pointer product_image" onclick="ew.sort(event,'<?php echo $Page->sortUrl($Page->image) ?>',0);">
			<span class="ew-table-header-caption"><?php echo $Page->image->caption() ?></span>
			<span class="ew-table-header-sort"><?php if ($Page->image->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($Page->image->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span>
		</div>
<?php } ?>
	</td>
<?php } ?>
<?php } ?>
<?php if ($Page->HSN_code->Visible) { ?>
<?php if ($Page->Export <> "" || $Page->DrillDown) { ?>
	<td data-field="HSN_code"><div class="product_HSN_code"><span class="ew-table-header-caption"><?php echo $Page->HSN_code->caption() ?></span></div></td>
<?php } else { ?>
	<td data-field="HSN_code">
<?php if ($Page->sortUrl($Page->HSN_code) == "") { ?>
		<div class="ew-table-header-btn product_HSN_code">
			<span class="ew-table-header-caption"><?php echo $Page->HSN_code->caption() ?></span>
		</div>
<?php } else { ?>
		<div class="ew-table-header-btn ew-pointer product_HSN_code" onclick="ew.sort(event,'<?php echo $Page->sortUrl($Page->HSN_code) ?>',0);">
			<span class="ew-table-header-caption"><?php echo $Page->HSN_code->caption() ?></span>
			<span class="ew-table-header-sort"><?php if ($Page->HSN_code->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($Page->HSN_code->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span>
		</div>
<?php } ?>
	</td>
<?php } ?>
<?php } ?>
<?php if ($Page->GST_rate->Visible) { ?>
<?php if ($Page->Export <> "" || $Page->DrillDown) { ?>
	<td data-field="GST_rate"><div class="product_GST_rate"><span class="ew-table-header-caption"><?php echo $Page->GST_rate->caption() ?></span></div></td>
<?php } else { ?>
	<td data-field="GST_rate">
<?php if ($Page->sortUrl($Page->GST_rate) == "") { ?>
		<div class="ew-table-header-btn product_GST_rate">
			<span class="ew-table-header-caption"><?php echo $Page->GST_rate->caption() ?></span>
		</div>
<?php } else { ?>
		<div class="ew-table-header-btn ew-pointer product_GST_rate" onclick="ew.sort(event,'<?php echo $Page->sortUrl($Page->GST_rate) ?>',0);">
			<span class="ew-table-header-caption"><?php echo $Page->GST_rate->caption() ?></span>
			<span class="ew-table-header-sort"><?php if ($Page->GST_rate->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($Page->GST_rate->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span>
		</div>
<?php } ?>
	</td>
<?php } ?>
<?php } ?>
<?php if ($Page->subcategory_idsubcategory->Visible) { ?>
<?php if ($Page->Export <> "" || $Page->DrillDown) { ?>
	<td data-field="subcategory_idsubcategory"><div class="product_subcategory_idsubcategory"><span class="ew-table-header-caption"><?php echo $Page->subcategory_idsubcategory->caption() ?></span></div></td>
<?php } else { ?>
	<td data-field="subcategory_idsubcategory">
<?php if ($Page->sortUrl($Page->subcategory_idsubcategory) == "") { ?>
		<div class="ew-table-header-btn product_subcategory_idsubcategory">
			<span class="ew-table-header-caption"><?php echo $Page->subcategory_idsubcategory->caption() ?></span>
		</div>
<?php } else { ?>
		<div class="ew-table-header-btn ew-pointer product_subcategory_idsubcategory" onclick="ew.sort(event,'<?php echo $Page->sortUrl($Page->subcategory_idsubcategory) ?>',0);">
			<span class="ew-table-header-caption"><?php echo $Page->subcategory_idsubcategory->caption() ?></span>
			<span class="ew-table-header-sort"><?php if ($Page->subcategory_idsubcategory->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($Page->subcategory_idsubcategory->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span>
		</div>
<?php } ?>
	</td>
<?php } ?>
<?php } ?>
<?php if ($Page->User_idRegister->Visible) { ?>
<?php if ($Page->Export <> "" || $Page->DrillDown) { ?>
	<td data-field="User_idRegister"><div class="product_User_idRegister"><span class="ew-table-header-caption"><?php echo $Page->User_idRegister->caption() ?></span></div></td>
<?php } else { ?>
	<td data-field="User_idRegister">
<?php if ($Page->sortUrl($Page->User_idRegister) == "") { ?>
		<div class="ew-table-header-btn product_User_idRegister">
			<span class="ew-table-header-caption"><?php echo $Page->User_idRegister->caption() ?></span>
		</div>
<?php } else { ?>
		<div class="ew-table-header-btn ew-pointer product_User_idRegister" onclick="ew.sort(event,'<?php echo $Page->sortUrl($Page->User_idRegister) ?>',0);">
			<span class="ew-table-header-caption"><?php echo $Page->User_idRegister->caption() ?></span>
			<span class="ew-table-header-sort"><?php if ($Page->User_idRegister->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($Page->User_idRegister->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span>
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
	$Page->RecordCount++;
	$Page->RecordIndex++;
?>
<?php

		// Render detail row
		$Page->resetAttributes();
		$Page->RowType = ROWTYPE_DETAIL;
		$Page->renderRow();
?>
	<tr<?php echo $Page->rowAttributes(); ?>>
<?php if ($Page->idproduct->Visible) { ?>
		<td data-field="idproduct"<?php echo $Page->idproduct->cellAttributes() ?>>
<span<?php echo $Page->idproduct->viewAttributes() ?>><?php echo $Page->idproduct->getViewValue() ?></span></td>
<?php } ?>
<?php if ($Page->pname->Visible) { ?>
		<td data-field="pname"<?php echo $Page->pname->cellAttributes() ?>>
<span<?php echo $Page->pname->viewAttributes() ?>><?php echo $Page->pname->getViewValue() ?></span></td>
<?php } ?>
<?php if ($Page->brand->Visible) { ?>
		<td data-field="brand"<?php echo $Page->brand->cellAttributes() ?>>
<span<?php echo $Page->brand->viewAttributes() ?>><?php echo $Page->brand->getViewValue() ?></span></td>
<?php } ?>
<?php if ($Page->minimum_set_qut_pur->Visible) { ?>
		<td data-field="minimum_set_qut_pur"<?php echo $Page->minimum_set_qut_pur->cellAttributes() ?>>
<span<?php echo $Page->minimum_set_qut_pur->viewAttributes() ?>><?php echo $Page->minimum_set_qut_pur->getViewValue() ?></span></td>
<?php } ?>
<?php if ($Page->quantity_of_1_set->Visible) { ?>
		<td data-field="quantity_of_1_set"<?php echo $Page->quantity_of_1_set->cellAttributes() ?>>
<span<?php echo $Page->quantity_of_1_set->viewAttributes() ?>><?php echo $Page->quantity_of_1_set->getViewValue() ?></span></td>
<?php } ?>
<?php if ($Page->MRP->Visible) { ?>
		<td data-field="MRP"<?php echo $Page->MRP->cellAttributes() ?>>
<span<?php echo $Page->MRP->viewAttributes() ?>><?php echo $Page->MRP->getViewValue() ?></span></td>
<?php } ?>
<?php if ($Page->price->Visible) { ?>
		<td data-field="price"<?php echo $Page->price->cellAttributes() ?>>
<span<?php echo $Page->price->viewAttributes() ?>><?php echo $Page->price->getViewValue() ?></span></td>
<?php } ?>
<?php if ($Page->image->Visible) { ?>
		<td data-field="image"<?php echo $Page->image->cellAttributes() ?>>
<span<?php echo $Page->image->viewAttributes() ?>><?php echo $Page->image->getViewValue() ?></span></td>
<?php } ?>
<?php if ($Page->HSN_code->Visible) { ?>
		<td data-field="HSN_code"<?php echo $Page->HSN_code->cellAttributes() ?>>
<span<?php echo $Page->HSN_code->viewAttributes() ?>><?php echo $Page->HSN_code->getViewValue() ?></span></td>
<?php } ?>
<?php if ($Page->GST_rate->Visible) { ?>
		<td data-field="GST_rate"<?php echo $Page->GST_rate->cellAttributes() ?>>
<span<?php echo $Page->GST_rate->viewAttributes() ?>><?php echo $Page->GST_rate->getViewValue() ?></span></td>
<?php } ?>
<?php if ($Page->subcategory_idsubcategory->Visible) { ?>
		<td data-field="subcategory_idsubcategory"<?php echo $Page->subcategory_idsubcategory->cellAttributes() ?>>
<span<?php echo $Page->subcategory_idsubcategory->viewAttributes() ?>><?php echo $Page->subcategory_idsubcategory->getViewValue() ?></span></td>
<?php } ?>
<?php if ($Page->User_idRegister->Visible) { ?>
		<td data-field="User_idRegister"<?php echo $Page->User_idRegister->cellAttributes() ?>>
<span<?php echo $Page->User_idRegister->viewAttributes() ?>><?php echo $Page->User_idRegister->getViewValue() ?></span></td>
<?php } ?>
	</tr>
<?php

		// Accumulate page summary
		$Page->accumulateSummary();

		// Get next record
		$Page->loadRowValues();
	$Page->GroupCount++;
} // End while
?>
<?php if ($Page->TotalGroups > 0) { ?>
</tbody>
<tfoot>
	</tfoot>
<?php } elseif (!$Page->ShowHeader && FALSE) { // No header displayed ?>
<?php if ($Page->Export <> "pdf") { ?>
<?php if ($Page->Export == "word" || $Page->Export == "excel") { ?>
<div class="ew-grid"<?php echo $Page->ReportTableStyle ?>>
<?php } else { ?>
<div class="card ew-card ew-grid"<?php echo $Page->ReportTableStyle ?>>
<?php } ?>
<?php } ?>
<!-- Report grid (begin) -->
<?php if ($Page->Export <> "pdf") { ?>
<div id="gmp_product" class="<?php if (IsResponsiveLayout()) { echo "table-responsive "; } ?>ew-grid-middle-panel">
<?php } ?>
<table class="<?php echo $Page->ReportTableClass ?>">
<?php } ?>
<?php if ($Page->TotalGroups > 0 || FALSE) { // Show footer ?>
</table>
<?php if ($Page->Export <> "pdf") { ?>
</div>
<?php } ?>
<?php if ($Page->Export == "" && !($Page->DrillDown && $Page->TotalGroups > 0)) { ?>
<div class="card-footer ew-grid-lower-panel">
<?php include "product_pager.php" ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php if ($Page->Export <> "pdf") { ?>
</div>
<?php } ?>
<?php } ?>
<?php if ($Page->Export <> "pdf") { ?>
</div>
<?php } ?>
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