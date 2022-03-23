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
if (!isset($sales_orders_rpt))
	$sales_orders_rpt = new sales_orders_rpt();
if (isset($Page))
	$OldPage = $Page;
$Page = &$sales_orders_rpt;

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
<div id="ew-center" class="<?php echo $sales_orders_rpt->CenterContentClass ?>">
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
<div id="gmp_sales_orders" class="<?php if (IsResponsiveLayout()) { echo "table-responsive "; } ?>ew-grid-middle-panel">
<table class="<?php echo $Page->ReportTableClass ?>">
<thead>
	<!-- Table header -->
	<tr class="ew-table-header">
<?php if ($Page->idsales_orders->Visible) { ?>
<?php if ($Page->Export <> "" || $Page->DrillDown) { ?>
	<td data-field="idsales_orders"><div class="sales_orders_idsales_orders"><span class="ew-table-header-caption"><?php echo $Page->idsales_orders->caption() ?></span></div></td>
<?php } else { ?>
	<td data-field="idsales_orders">
<?php if ($Page->sortUrl($Page->idsales_orders) == "") { ?>
		<div class="ew-table-header-btn sales_orders_idsales_orders">
			<span class="ew-table-header-caption"><?php echo $Page->idsales_orders->caption() ?></span>
		</div>
<?php } else { ?>
		<div class="ew-table-header-btn ew-pointer sales_orders_idsales_orders" onclick="ew.sort(event,'<?php echo $Page->sortUrl($Page->idsales_orders) ?>',0);">
			<span class="ew-table-header-caption"><?php echo $Page->idsales_orders->caption() ?></span>
			<span class="ew-table-header-sort"><?php if ($Page->idsales_orders->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($Page->idsales_orders->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span>
		</div>
<?php } ?>
	</td>
<?php } ?>
<?php } ?>
<?php if ($Page->order_date->Visible) { ?>
<?php if ($Page->Export <> "" || $Page->DrillDown) { ?>
	<td data-field="order_date"><div class="sales_orders_order_date"><span class="ew-table-header-caption"><?php echo $Page->order_date->caption() ?></span></div></td>
<?php } else { ?>
	<td data-field="order_date">
<?php if ($Page->sortUrl($Page->order_date) == "") { ?>
		<div class="ew-table-header-btn sales_orders_order_date">
			<span class="ew-table-header-caption"><?php echo $Page->order_date->caption() ?></span>
		</div>
<?php } else { ?>
		<div class="ew-table-header-btn ew-pointer sales_orders_order_date" onclick="ew.sort(event,'<?php echo $Page->sortUrl($Page->order_date) ?>',0);">
			<span class="ew-table-header-caption"><?php echo $Page->order_date->caption() ?></span>
			<span class="ew-table-header-sort"><?php if ($Page->order_date->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($Page->order_date->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span>
		</div>
<?php } ?>
	</td>
<?php } ?>
<?php } ?>
<?php if ($Page->last_shipping_date->Visible) { ?>
<?php if ($Page->Export <> "" || $Page->DrillDown) { ?>
	<td data-field="last_shipping_date"><div class="sales_orders_last_shipping_date"><span class="ew-table-header-caption"><?php echo $Page->last_shipping_date->caption() ?></span></div></td>
<?php } else { ?>
	<td data-field="last_shipping_date">
<?php if ($Page->sortUrl($Page->last_shipping_date) == "") { ?>
		<div class="ew-table-header-btn sales_orders_last_shipping_date">
			<span class="ew-table-header-caption"><?php echo $Page->last_shipping_date->caption() ?></span>
		</div>
<?php } else { ?>
		<div class="ew-table-header-btn ew-pointer sales_orders_last_shipping_date" onclick="ew.sort(event,'<?php echo $Page->sortUrl($Page->last_shipping_date) ?>',0);">
			<span class="ew-table-header-caption"><?php echo $Page->last_shipping_date->caption() ?></span>
			<span class="ew-table-header-sort"><?php if ($Page->last_shipping_date->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($Page->last_shipping_date->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span>
		</div>
<?php } ?>
	</td>
<?php } ?>
<?php } ?>
<?php if ($Page->taxable_amount->Visible) { ?>
<?php if ($Page->Export <> "" || $Page->DrillDown) { ?>
	<td data-field="taxable_amount"><div class="sales_orders_taxable_amount"><span class="ew-table-header-caption"><?php echo $Page->taxable_amount->caption() ?></span></div></td>
<?php } else { ?>
	<td data-field="taxable_amount">
<?php if ($Page->sortUrl($Page->taxable_amount) == "") { ?>
		<div class="ew-table-header-btn sales_orders_taxable_amount">
			<span class="ew-table-header-caption"><?php echo $Page->taxable_amount->caption() ?></span>
		</div>
<?php } else { ?>
		<div class="ew-table-header-btn ew-pointer sales_orders_taxable_amount" onclick="ew.sort(event,'<?php echo $Page->sortUrl($Page->taxable_amount) ?>',0);">
			<span class="ew-table-header-caption"><?php echo $Page->taxable_amount->caption() ?></span>
			<span class="ew-table-header-sort"><?php if ($Page->taxable_amount->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($Page->taxable_amount->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span>
		</div>
<?php } ?>
	</td>
<?php } ?>
<?php } ?>
<?php if ($Page->tax_amount->Visible) { ?>
<?php if ($Page->Export <> "" || $Page->DrillDown) { ?>
	<td data-field="tax_amount"><div class="sales_orders_tax_amount"><span class="ew-table-header-caption"><?php echo $Page->tax_amount->caption() ?></span></div></td>
<?php } else { ?>
	<td data-field="tax_amount">
<?php if ($Page->sortUrl($Page->tax_amount) == "") { ?>
		<div class="ew-table-header-btn sales_orders_tax_amount">
			<span class="ew-table-header-caption"><?php echo $Page->tax_amount->caption() ?></span>
		</div>
<?php } else { ?>
		<div class="ew-table-header-btn ew-pointer sales_orders_tax_amount" onclick="ew.sort(event,'<?php echo $Page->sortUrl($Page->tax_amount) ?>',0);">
			<span class="ew-table-header-caption"><?php echo $Page->tax_amount->caption() ?></span>
			<span class="ew-table-header-sort"><?php if ($Page->tax_amount->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($Page->tax_amount->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span>
		</div>
<?php } ?>
	</td>
<?php } ?>
<?php } ?>
<?php if ($Page->net_amount->Visible) { ?>
<?php if ($Page->Export <> "" || $Page->DrillDown) { ?>
	<td data-field="net_amount"><div class="sales_orders_net_amount"><span class="ew-table-header-caption"><?php echo $Page->net_amount->caption() ?></span></div></td>
<?php } else { ?>
	<td data-field="net_amount">
<?php if ($Page->sortUrl($Page->net_amount) == "") { ?>
		<div class="ew-table-header-btn sales_orders_net_amount">
			<span class="ew-table-header-caption"><?php echo $Page->net_amount->caption() ?></span>
		</div>
<?php } else { ?>
		<div class="ew-table-header-btn ew-pointer sales_orders_net_amount" onclick="ew.sort(event,'<?php echo $Page->sortUrl($Page->net_amount) ?>',0);">
			<span class="ew-table-header-caption"><?php echo $Page->net_amount->caption() ?></span>
			<span class="ew-table-header-sort"><?php if ($Page->net_amount->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($Page->net_amount->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span>
		</div>
<?php } ?>
	</td>
<?php } ?>
<?php } ?>
<?php if ($Page->User_idRegister->Visible) { ?>
<?php if ($Page->Export <> "" || $Page->DrillDown) { ?>
	<td data-field="User_idRegister"><div class="sales_orders_User_idRegister"><span class="ew-table-header-caption"><?php echo $Page->User_idRegister->caption() ?></span></div></td>
<?php } else { ?>
	<td data-field="User_idRegister">
<?php if ($Page->sortUrl($Page->User_idRegister) == "") { ?>
		<div class="ew-table-header-btn sales_orders_User_idRegister">
			<span class="ew-table-header-caption"><?php echo $Page->User_idRegister->caption() ?></span>
		</div>
<?php } else { ?>
		<div class="ew-table-header-btn ew-pointer sales_orders_User_idRegister" onclick="ew.sort(event,'<?php echo $Page->sortUrl($Page->User_idRegister) ?>',0);">
			<span class="ew-table-header-caption"><?php echo $Page->User_idRegister->caption() ?></span>
			<span class="ew-table-header-sort"><?php if ($Page->User_idRegister->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($Page->User_idRegister->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span>
		</div>
<?php } ?>
	</td>
<?php } ?>
<?php } ?>
<?php if ($Page->offers_idoffers->Visible) { ?>
<?php if ($Page->Export <> "" || $Page->DrillDown) { ?>
	<td data-field="offers_idoffers"><div class="sales_orders_offers_idoffers"><span class="ew-table-header-caption"><?php echo $Page->offers_idoffers->caption() ?></span></div></td>
<?php } else { ?>
	<td data-field="offers_idoffers">
<?php if ($Page->sortUrl($Page->offers_idoffers) == "") { ?>
		<div class="ew-table-header-btn sales_orders_offers_idoffers">
			<span class="ew-table-header-caption"><?php echo $Page->offers_idoffers->caption() ?></span>
		</div>
<?php } else { ?>
		<div class="ew-table-header-btn ew-pointer sales_orders_offers_idoffers" onclick="ew.sort(event,'<?php echo $Page->sortUrl($Page->offers_idoffers) ?>',0);">
			<span class="ew-table-header-caption"><?php echo $Page->offers_idoffers->caption() ?></span>
			<span class="ew-table-header-sort"><?php if ($Page->offers_idoffers->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($Page->offers_idoffers->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span>
		</div>
<?php } ?>
	</td>
<?php } ?>
<?php } ?>
<?php if ($Page->Is_canceled->Visible) { ?>
<?php if ($Page->Export <> "" || $Page->DrillDown) { ?>
	<td data-field="Is_canceled"><div class="sales_orders_Is_canceled"><span class="ew-table-header-caption"><?php echo $Page->Is_canceled->caption() ?></span></div></td>
<?php } else { ?>
	<td data-field="Is_canceled">
<?php if ($Page->sortUrl($Page->Is_canceled) == "") { ?>
		<div class="ew-table-header-btn sales_orders_Is_canceled">
			<span class="ew-table-header-caption"><?php echo $Page->Is_canceled->caption() ?></span>
		</div>
<?php } else { ?>
		<div class="ew-table-header-btn ew-pointer sales_orders_Is_canceled" onclick="ew.sort(event,'<?php echo $Page->sortUrl($Page->Is_canceled) ?>',0);">
			<span class="ew-table-header-caption"><?php echo $Page->Is_canceled->caption() ?></span>
			<span class="ew-table-header-sort"><?php if ($Page->Is_canceled->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($Page->Is_canceled->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span>
		</div>
<?php } ?>
	</td>
<?php } ?>
<?php } ?>
<?php if ($Page->reason->Visible) { ?>
<?php if ($Page->Export <> "" || $Page->DrillDown) { ?>
	<td data-field="reason"><div class="sales_orders_reason"><span class="ew-table-header-caption"><?php echo $Page->reason->caption() ?></span></div></td>
<?php } else { ?>
	<td data-field="reason">
<?php if ($Page->sortUrl($Page->reason) == "") { ?>
		<div class="ew-table-header-btn sales_orders_reason">
			<span class="ew-table-header-caption"><?php echo $Page->reason->caption() ?></span>
		</div>
<?php } else { ?>
		<div class="ew-table-header-btn ew-pointer sales_orders_reason" onclick="ew.sort(event,'<?php echo $Page->sortUrl($Page->reason) ?>',0);">
			<span class="ew-table-header-caption"><?php echo $Page->reason->caption() ?></span>
			<span class="ew-table-header-sort"><?php if ($Page->reason->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($Page->reason->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span>
		</div>
<?php } ?>
	</td>
<?php } ?>
<?php } ?>
<?php if ($Page->cancel_date->Visible) { ?>
<?php if ($Page->Export <> "" || $Page->DrillDown) { ?>
	<td data-field="cancel_date"><div class="sales_orders_cancel_date"><span class="ew-table-header-caption"><?php echo $Page->cancel_date->caption() ?></span></div></td>
<?php } else { ?>
	<td data-field="cancel_date">
<?php if ($Page->sortUrl($Page->cancel_date) == "") { ?>
		<div class="ew-table-header-btn sales_orders_cancel_date">
			<span class="ew-table-header-caption"><?php echo $Page->cancel_date->caption() ?></span>
		</div>
<?php } else { ?>
		<div class="ew-table-header-btn ew-pointer sales_orders_cancel_date" onclick="ew.sort(event,'<?php echo $Page->sortUrl($Page->cancel_date) ?>',0);">
			<span class="ew-table-header-caption"><?php echo $Page->cancel_date->caption() ?></span>
			<span class="ew-table-header-sort"><?php if ($Page->cancel_date->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($Page->cancel_date->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span>
		</div>
<?php } ?>
	</td>
<?php } ?>
<?php } ?>
<?php if ($Page->is_payment->Visible) { ?>
<?php if ($Page->Export <> "" || $Page->DrillDown) { ?>
	<td data-field="is_payment"><div class="sales_orders_is_payment"><span class="ew-table-header-caption"><?php echo $Page->is_payment->caption() ?></span></div></td>
<?php } else { ?>
	<td data-field="is_payment">
<?php if ($Page->sortUrl($Page->is_payment) == "") { ?>
		<div class="ew-table-header-btn sales_orders_is_payment">
			<span class="ew-table-header-caption"><?php echo $Page->is_payment->caption() ?></span>
		</div>
<?php } else { ?>
		<div class="ew-table-header-btn ew-pointer sales_orders_is_payment" onclick="ew.sort(event,'<?php echo $Page->sortUrl($Page->is_payment) ?>',0);">
			<span class="ew-table-header-caption"><?php echo $Page->is_payment->caption() ?></span>
			<span class="ew-table-header-sort"><?php if ($Page->is_payment->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($Page->is_payment->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span>
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
<?php if ($Page->idsales_orders->Visible) { ?>
		<td data-field="idsales_orders"<?php echo $Page->idsales_orders->cellAttributes() ?>>
<span<?php echo $Page->idsales_orders->viewAttributes() ?>><?php echo $Page->idsales_orders->getViewValue() ?></span></td>
<?php } ?>
<?php if ($Page->order_date->Visible) { ?>
		<td data-field="order_date"<?php echo $Page->order_date->cellAttributes() ?>>
<span<?php echo $Page->order_date->viewAttributes() ?>><?php echo $Page->order_date->getViewValue() ?></span></td>
<?php } ?>
<?php if ($Page->last_shipping_date->Visible) { ?>
		<td data-field="last_shipping_date"<?php echo $Page->last_shipping_date->cellAttributes() ?>>
<span<?php echo $Page->last_shipping_date->viewAttributes() ?>><?php echo $Page->last_shipping_date->getViewValue() ?></span></td>
<?php } ?>
<?php if ($Page->taxable_amount->Visible) { ?>
		<td data-field="taxable_amount"<?php echo $Page->taxable_amount->cellAttributes() ?>>
<span<?php echo $Page->taxable_amount->viewAttributes() ?>><?php echo $Page->taxable_amount->getViewValue() ?></span></td>
<?php } ?>
<?php if ($Page->tax_amount->Visible) { ?>
		<td data-field="tax_amount"<?php echo $Page->tax_amount->cellAttributes() ?>>
<span<?php echo $Page->tax_amount->viewAttributes() ?>><?php echo $Page->tax_amount->getViewValue() ?></span></td>
<?php } ?>
<?php if ($Page->net_amount->Visible) { ?>
		<td data-field="net_amount"<?php echo $Page->net_amount->cellAttributes() ?>>
<span<?php echo $Page->net_amount->viewAttributes() ?>><?php echo $Page->net_amount->getViewValue() ?></span></td>
<?php } ?>
<?php if ($Page->User_idRegister->Visible) { ?>
		<td data-field="User_idRegister"<?php echo $Page->User_idRegister->cellAttributes() ?>>
<span<?php echo $Page->User_idRegister->viewAttributes() ?>><?php echo $Page->User_idRegister->getViewValue() ?></span></td>
<?php } ?>
<?php if ($Page->offers_idoffers->Visible) { ?>
		<td data-field="offers_idoffers"<?php echo $Page->offers_idoffers->cellAttributes() ?>>
<span<?php echo $Page->offers_idoffers->viewAttributes() ?>><?php echo $Page->offers_idoffers->getViewValue() ?></span></td>
<?php } ?>
<?php if ($Page->Is_canceled->Visible) { ?>
		<td data-field="Is_canceled"<?php echo $Page->Is_canceled->cellAttributes() ?>>
<span<?php echo $Page->Is_canceled->viewAttributes() ?>><?php echo $Page->Is_canceled->getViewValue() ?></span></td>
<?php } ?>
<?php if ($Page->reason->Visible) { ?>
		<td data-field="reason"<?php echo $Page->reason->cellAttributes() ?>>
<span<?php echo $Page->reason->viewAttributes() ?>><?php echo $Page->reason->getViewValue() ?></span></td>
<?php } ?>
<?php if ($Page->cancel_date->Visible) { ?>
		<td data-field="cancel_date"<?php echo $Page->cancel_date->cellAttributes() ?>>
<span<?php echo $Page->cancel_date->viewAttributes() ?>><?php echo $Page->cancel_date->getViewValue() ?></span></td>
<?php } ?>
<?php if ($Page->is_payment->Visible) { ?>
		<td data-field="is_payment"<?php echo $Page->is_payment->cellAttributes() ?>>
<span<?php echo $Page->is_payment->viewAttributes() ?>><?php echo $Page->is_payment->getViewValue() ?></span></td>
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
<?php if ($Page->Export == "word" || $Page->Export == "excel") { ?>
<div class="ew-grid"<?php echo $Page->ReportTableStyle ?>>
<?php } else { ?>
<div class="card ew-card ew-grid"<?php echo $Page->ReportTableStyle ?>>
<?php } ?>
<!-- Report grid (begin) -->
<div id="gmp_sales_orders" class="<?php if (IsResponsiveLayout()) { echo "table-responsive "; } ?>ew-grid-middle-panel">
<table class="<?php echo $Page->ReportTableClass ?>">
<?php } ?>
<?php if ($Page->TotalGroups > 0 || FALSE) { // Show footer ?>
</table>
</div>
<?php if ($Page->Export == "" && !($Page->DrillDown && $Page->TotalGroups > 0)) { ?>
<div class="card-footer ew-grid-lower-panel">
<?php include "sales_orders_pager.php" ?>
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