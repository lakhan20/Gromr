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
if (!isset($Order_Report_summary))
	$Order_Report_summary = new Order_Report_summary();
if (isset($Page))
	$OldPage = $Page;
$Page = &$Order_Report_summary;

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
<div id="ew-center" class="<?php echo $Order_Report_summary->CenterContentClass ?>">
<?php } ?>
<!-- Summary Report begins -->
<div id="report_summary">
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
<?php if ($Page->Export == "word" || $Page->Export == "excel") { ?>
<div class="ew-grid"<?php echo $Page->ReportTableStyle ?>>
<?php } else { ?>
<div class="card ew-card ew-grid"<?php echo $Page->ReportTableStyle ?>>
<?php } ?>
<!-- Report grid (begin) -->
<div id="gmp_Order_Report" class="<?php if (IsResponsiveLayout()) { echo "table-responsive "; } ?>ew-grid-middle-panel">
<table class="<?php echo $Page->ReportTableClass ?>">
<thead>
	<!-- Table header -->
	<tr class="ew-table-header">
<?php if ($Page->Qty->Visible) { ?>
<?php if ($Page->Export <> "" || $Page->DrillDown) { ?>
	<td data-field="Qty"><div class="Order_Report_Qty"><span class="ew-table-header-caption"><?php echo $Page->Qty->caption() ?></span></div></td>
<?php } else { ?>
	<td data-field="Qty">
<?php if ($Page->sortUrl($Page->Qty) == "") { ?>
		<div class="ew-table-header-btn Order_Report_Qty">
			<span class="ew-table-header-caption"><?php echo $Page->Qty->caption() ?></span>
		</div>
<?php } else { ?>
		<div class="ew-table-header-btn ew-pointer Order_Report_Qty" onclick="ew.sort(event,'<?php echo $Page->sortUrl($Page->Qty) ?>',0);">
			<span class="ew-table-header-caption"><?php echo $Page->Qty->caption() ?></span>
			<span class="ew-table-header-sort"><?php if ($Page->Qty->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($Page->Qty->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span>
		</div>
<?php } ?>
	</td>
<?php } ?>
<?php } ?>
<?php if ($Page->Price->Visible) { ?>
<?php if ($Page->Export <> "" || $Page->DrillDown) { ?>
	<td data-field="Price"><div class="Order_Report_Price"><span class="ew-table-header-caption"><?php echo $Page->Price->caption() ?></span></div></td>
<?php } else { ?>
	<td data-field="Price">
<?php if ($Page->sortUrl($Page->Price) == "") { ?>
		<div class="ew-table-header-btn Order_Report_Price">
			<span class="ew-table-header-caption"><?php echo $Page->Price->caption() ?></span>
		</div>
<?php } else { ?>
		<div class="ew-table-header-btn ew-pointer Order_Report_Price" onclick="ew.sort(event,'<?php echo $Page->sortUrl($Page->Price) ?>',0);">
			<span class="ew-table-header-caption"><?php echo $Page->Price->caption() ?></span>
			<span class="ew-table-header-sort"><?php if ($Page->Price->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($Page->Price->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span>
		</div>
<?php } ?>
	</td>
<?php } ?>
<?php } ?>
<?php if ($Page->discount->Visible) { ?>
<?php if ($Page->Export <> "" || $Page->DrillDown) { ?>
	<td data-field="discount"><div class="Order_Report_discount"><span class="ew-table-header-caption"><?php echo $Page->discount->caption() ?></span></div></td>
<?php } else { ?>
	<td data-field="discount">
<?php if ($Page->sortUrl($Page->discount) == "") { ?>
		<div class="ew-table-header-btn Order_Report_discount">
			<span class="ew-table-header-caption"><?php echo $Page->discount->caption() ?></span>
		</div>
<?php } else { ?>
		<div class="ew-table-header-btn ew-pointer Order_Report_discount" onclick="ew.sort(event,'<?php echo $Page->sortUrl($Page->discount) ?>',0);">
			<span class="ew-table-header-caption"><?php echo $Page->discount->caption() ?></span>
			<span class="ew-table-header-sort"><?php if ($Page->discount->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($Page->discount->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span>
		</div>
<?php } ?>
	</td>
<?php } ?>
<?php } ?>
<?php if ($Page->order_date->Visible) { ?>
<?php if ($Page->Export <> "" || $Page->DrillDown) { ?>
	<td data-field="order_date"><div class="Order_Report_order_date"><span class="ew-table-header-caption"><?php echo $Page->order_date->caption() ?></span></div></td>
<?php } else { ?>
	<td data-field="order_date">
<?php if ($Page->sortUrl($Page->order_date) == "") { ?>
		<div class="ew-table-header-btn Order_Report_order_date">
			<span class="ew-table-header-caption"><?php echo $Page->order_date->caption() ?></span>
		</div>
<?php } else { ?>
		<div class="ew-table-header-btn ew-pointer Order_Report_order_date" onclick="ew.sort(event,'<?php echo $Page->sortUrl($Page->order_date) ?>',0);">
			<span class="ew-table-header-caption"><?php echo $Page->order_date->caption() ?></span>
			<span class="ew-table-header-sort"><?php if ($Page->order_date->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($Page->order_date->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span>
		</div>
<?php } ?>
	</td>
<?php } ?>
<?php } ?>
<?php if ($Page->last_shipping_date->Visible) { ?>
<?php if ($Page->Export <> "" || $Page->DrillDown) { ?>
	<td data-field="last_shipping_date"><div class="Order_Report_last_shipping_date"><span class="ew-table-header-caption"><?php echo $Page->last_shipping_date->caption() ?></span></div></td>
<?php } else { ?>
	<td data-field="last_shipping_date">
<?php if ($Page->sortUrl($Page->last_shipping_date) == "") { ?>
		<div class="ew-table-header-btn Order_Report_last_shipping_date">
			<span class="ew-table-header-caption"><?php echo $Page->last_shipping_date->caption() ?></span>
		</div>
<?php } else { ?>
		<div class="ew-table-header-btn ew-pointer Order_Report_last_shipping_date" onclick="ew.sort(event,'<?php echo $Page->sortUrl($Page->last_shipping_date) ?>',0);">
			<span class="ew-table-header-caption"><?php echo $Page->last_shipping_date->caption() ?></span>
			<span class="ew-table-header-sort"><?php if ($Page->last_shipping_date->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($Page->last_shipping_date->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span>
		</div>
<?php } ?>
	</td>
<?php } ?>
<?php } ?>
<?php if ($Page->tax_amount->Visible) { ?>
<?php if ($Page->Export <> "" || $Page->DrillDown) { ?>
	<td data-field="tax_amount"><div class="Order_Report_tax_amount"><span class="ew-table-header-caption"><?php echo $Page->tax_amount->caption() ?></span></div></td>
<?php } else { ?>
	<td data-field="tax_amount">
<?php if ($Page->sortUrl($Page->tax_amount) == "") { ?>
		<div class="ew-table-header-btn Order_Report_tax_amount">
			<span class="ew-table-header-caption"><?php echo $Page->tax_amount->caption() ?></span>
		</div>
<?php } else { ?>
		<div class="ew-table-header-btn ew-pointer Order_Report_tax_amount" onclick="ew.sort(event,'<?php echo $Page->sortUrl($Page->tax_amount) ?>',0);">
			<span class="ew-table-header-caption"><?php echo $Page->tax_amount->caption() ?></span>
			<span class="ew-table-header-sort"><?php if ($Page->tax_amount->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($Page->tax_amount->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span>
		</div>
<?php } ?>
	</td>
<?php } ?>
<?php } ?>
<?php if ($Page->net_amount->Visible) { ?>
<?php if ($Page->Export <> "" || $Page->DrillDown) { ?>
	<td data-field="net_amount"><div class="Order_Report_net_amount"><span class="ew-table-header-caption"><?php echo $Page->net_amount->caption() ?></span></div></td>
<?php } else { ?>
	<td data-field="net_amount">
<?php if ($Page->sortUrl($Page->net_amount) == "") { ?>
		<div class="ew-table-header-btn Order_Report_net_amount">
			<span class="ew-table-header-caption"><?php echo $Page->net_amount->caption() ?></span>
		</div>
<?php } else { ?>
		<div class="ew-table-header-btn ew-pointer Order_Report_net_amount" onclick="ew.sort(event,'<?php echo $Page->sortUrl($Page->net_amount) ?>',0);">
			<span class="ew-table-header-caption"><?php echo $Page->net_amount->caption() ?></span>
			<span class="ew-table-header-sort"><?php if ($Page->net_amount->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($Page->net_amount->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span>
		</div>
<?php } ?>
	</td>
<?php } ?>
<?php } ?>
<?php if ($Page->pname->Visible) { ?>
<?php if ($Page->Export <> "" || $Page->DrillDown) { ?>
	<td data-field="pname"><div class="Order_Report_pname"><span class="ew-table-header-caption"><?php echo $Page->pname->caption() ?></span></div></td>
<?php } else { ?>
	<td data-field="pname">
<?php if ($Page->sortUrl($Page->pname) == "") { ?>
		<div class="ew-table-header-btn Order_Report_pname">
			<span class="ew-table-header-caption"><?php echo $Page->pname->caption() ?></span>
		</div>
<?php } else { ?>
		<div class="ew-table-header-btn ew-pointer Order_Report_pname" onclick="ew.sort(event,'<?php echo $Page->sortUrl($Page->pname) ?>',0);">
			<span class="ew-table-header-caption"><?php echo $Page->pname->caption() ?></span>
			<span class="ew-table-header-sort"><?php if ($Page->pname->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($Page->pname->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span>
		</div>
<?php } ?>
	</td>
<?php } ?>
<?php } ?>
<?php if ($Page->brand->Visible) { ?>
<?php if ($Page->Export <> "" || $Page->DrillDown) { ?>
	<td data-field="brand"><div class="Order_Report_brand"><span class="ew-table-header-caption"><?php echo $Page->brand->caption() ?></span></div></td>
<?php } else { ?>
	<td data-field="brand">
<?php if ($Page->sortUrl($Page->brand) == "") { ?>
		<div class="ew-table-header-btn Order_Report_brand">
			<span class="ew-table-header-caption"><?php echo $Page->brand->caption() ?></span>
		</div>
<?php } else { ?>
		<div class="ew-table-header-btn ew-pointer Order_Report_brand" onclick="ew.sort(event,'<?php echo $Page->sortUrl($Page->brand) ?>',0);">
			<span class="ew-table-header-caption"><?php echo $Page->brand->caption() ?></span>
			<span class="ew-table-header-sort"><?php if ($Page->brand->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($Page->brand->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span>
		</div>
<?php } ?>
	</td>
<?php } ?>
<?php } ?>
<?php if ($Page->description->Visible) { ?>
<?php if ($Page->Export <> "" || $Page->DrillDown) { ?>
	<td data-field="description"><div class="Order_Report_description"><span class="ew-table-header-caption"><?php echo $Page->description->caption() ?></span></div></td>
<?php } else { ?>
	<td data-field="description">
<?php if ($Page->sortUrl($Page->description) == "") { ?>
		<div class="ew-table-header-btn Order_Report_description">
			<span class="ew-table-header-caption"><?php echo $Page->description->caption() ?></span>
		</div>
<?php } else { ?>
		<div class="ew-table-header-btn ew-pointer Order_Report_description" onclick="ew.sort(event,'<?php echo $Page->sortUrl($Page->description) ?>',0);">
			<span class="ew-table-header-caption"><?php echo $Page->description->caption() ?></span>
			<span class="ew-table-header-sort"><?php if ($Page->description->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($Page->description->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span>
		</div>
<?php } ?>
	</td>
<?php } ?>
<?php } ?>
<?php if ($Page->bussiness_name->Visible) { ?>
<?php if ($Page->Export <> "" || $Page->DrillDown) { ?>
	<td data-field="bussiness_name"><div class="Order_Report_bussiness_name"><span class="ew-table-header-caption"><?php echo $Page->bussiness_name->caption() ?></span></div></td>
<?php } else { ?>
	<td data-field="bussiness_name">
<?php if ($Page->sortUrl($Page->bussiness_name) == "") { ?>
		<div class="ew-table-header-btn Order_Report_bussiness_name">
			<span class="ew-table-header-caption"><?php echo $Page->bussiness_name->caption() ?></span>
		</div>
<?php } else { ?>
		<div class="ew-table-header-btn ew-pointer Order_Report_bussiness_name" onclick="ew.sort(event,'<?php echo $Page->sortUrl($Page->bussiness_name) ?>',0);">
			<span class="ew-table-header-caption"><?php echo $Page->bussiness_name->caption() ?></span>
			<span class="ew-table-header-sort"><?php if ($Page->bussiness_name->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($Page->bussiness_name->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span>
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
<?php if ($Page->Qty->Visible) { ?>
		<td data-field="Qty"<?php echo $Page->Qty->cellAttributes() ?>>
<span<?php echo $Page->Qty->viewAttributes() ?>><?php echo $Page->Qty->getViewValue() ?></span></td>
<?php } ?>
<?php if ($Page->Price->Visible) { ?>
		<td data-field="Price"<?php echo $Page->Price->cellAttributes() ?>>
<span<?php echo $Page->Price->viewAttributes() ?>><?php echo $Page->Price->getViewValue() ?></span></td>
<?php } ?>
<?php if ($Page->discount->Visible) { ?>
		<td data-field="discount"<?php echo $Page->discount->cellAttributes() ?>>
<span<?php echo $Page->discount->viewAttributes() ?>><?php echo $Page->discount->getViewValue() ?></span></td>
<?php } ?>
<?php if ($Page->order_date->Visible) { ?>
		<td data-field="order_date"<?php echo $Page->order_date->cellAttributes() ?>>
<span<?php echo $Page->order_date->viewAttributes() ?>><?php echo $Page->order_date->getViewValue() ?></span></td>
<?php } ?>
<?php if ($Page->last_shipping_date->Visible) { ?>
		<td data-field="last_shipping_date"<?php echo $Page->last_shipping_date->cellAttributes() ?>>
<span<?php echo $Page->last_shipping_date->viewAttributes() ?>><?php echo $Page->last_shipping_date->getViewValue() ?></span></td>
<?php } ?>
<?php if ($Page->tax_amount->Visible) { ?>
		<td data-field="tax_amount"<?php echo $Page->tax_amount->cellAttributes() ?>>
<span<?php echo $Page->tax_amount->viewAttributes() ?>><?php echo $Page->tax_amount->getViewValue() ?></span></td>
<?php } ?>
<?php if ($Page->net_amount->Visible) { ?>
		<td data-field="net_amount"<?php echo $Page->net_amount->cellAttributes() ?>>
<span<?php echo $Page->net_amount->viewAttributes() ?>><?php echo $Page->net_amount->getViewValue() ?></span></td>
<?php } ?>
<?php if ($Page->pname->Visible) { ?>
		<td data-field="pname"<?php echo $Page->pname->cellAttributes() ?>>
<span<?php echo $Page->pname->viewAttributes() ?>><?php echo $Page->pname->getViewValue() ?></span></td>
<?php } ?>
<?php if ($Page->brand->Visible) { ?>
		<td data-field="brand"<?php echo $Page->brand->cellAttributes() ?>>
<span<?php echo $Page->brand->viewAttributes() ?>><?php echo $Page->brand->getViewValue() ?></span></td>
<?php } ?>
<?php if ($Page->description->Visible) { ?>
		<td data-field="description"<?php echo $Page->description->cellAttributes() ?>>
<span<?php echo $Page->description->viewAttributes() ?>><?php echo $Page->description->getViewValue() ?></span></td>
<?php } ?>
<?php if ($Page->bussiness_name->Visible) { ?>
		<td data-field="bussiness_name"<?php echo $Page->bussiness_name->cellAttributes() ?>>
<span<?php echo $Page->bussiness_name->viewAttributes() ?>><?php echo $Page->bussiness_name->getViewValue() ?></span></td>
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
<?php
	$Page->resetAttributes();
	$Page->RowType = ROWTYPE_TOTAL;
	$Page->RowTotalType = ROWTOTAL_GRAND;
	$Page->RowTotalSubType = ROWTOTAL_FOOTER;
	$Page->RowAttrs["class"] = "ew-rpt-grand-summary";
	$Page->renderRow();
?>
<?php if ($Page->ShowCompactSummaryFooter) { ?>
	<tr<?php echo $Page->rowAttributes() ?>><td colspan="<?php echo ($Page->GroupColumnCount + $Page->DetailColumnCount) ?>"><?php echo $ReportLanguage->Phrase("RptGrandSummary") ?> <span class="ew-summary-count">(<span class="ew-aggregate-caption"><?php echo $ReportLanguage->phrase("RptCnt") ?></span><?php echo $ReportLanguage->phrase("AggregateEqual") ?><span class="ew-aggregate-value"><?php echo FormatNumber($Page->TotalCount,0,-2,-2,-2) ?></span>)</span></td></tr>
<?php } else { ?>
	<tr<?php echo $Page->rowAttributes() ?>><td colspan="<?php echo ($Page->GroupColumnCount + $Page->DetailColumnCount) ?>"><?php echo $ReportLanguage->Phrase("RptGrandSummary") ?> <span class="ew-summary-count">(<?php echo FormatNumber($Page->TotalCount,0,-2,-2,-2); ?><?php echo $ReportLanguage->Phrase("RptDtlRec") ?>)</span></td></tr>
<?php } ?>
	</tfoot>
<?php } elseif (!$Page->ShowHeader && FALSE) { // No header displayed ?>
<?php if ($Page->Export == "word" || $Page->Export == "excel") { ?>
<div class="ew-grid"<?php echo $Page->ReportTableStyle ?>>
<?php } else { ?>
<div class="card ew-card ew-grid"<?php echo $Page->ReportTableStyle ?>>
<?php } ?>
<!-- Report grid (begin) -->
<div id="gmp_Order_Report" class="<?php if (IsResponsiveLayout()) { echo "table-responsive "; } ?>ew-grid-middle-panel">
<table class="<?php echo $Page->ReportTableClass ?>">
<?php } ?>
<?php if ($Page->TotalGroups > 0 || FALSE) { // Show footer ?>
</table>
</div>
<?php if ($Page->Export == "" && !($Page->DrillDown && $Page->TotalGroups > 0)) { ?>
<div class="card-footer ew-grid-lower-panel">
<?php include "Order_Report_pager.php" ?>
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