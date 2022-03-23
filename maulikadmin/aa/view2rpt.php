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
if (!isset($view2_rpt))
	$view2_rpt = new view2_rpt();
if (isset($Page))
	$OldPage = $Page;
$Page = &$view2_rpt;

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
<script>
// Form object
var fview2rpt = currentForm = new ew.Form("fview2rpt");

// Use Ajax
fview2rpt.lists["x_order_date"] = <?php echo $view2_rpt->order_date->Lookup->toClientList() ?>;
fview2rpt.lists["x_order_date"].popupValues = <?php echo json_encode($view2_rpt->order_date->SelectionList) ?>;
fview2rpt.lists["x_order_date"].popupOptions = <?php echo JsonEncode($view2_rpt->order_date->popupOptions()) ?>;
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
        <div id="ew-center" class="<?php echo $view2_rpt->CenterContentClass ?>">
            <?php } ?>
            <!-- Summary Report begins -->
            <?php if ($Page->Export <> "pdf") { ?>
            <div id="report_summary">
                <?php } ?>
                <?php if ($Page->Export == "" && !$Page->DrillDown && !$DashboardReport) { ?>
                <!-- Search form (begin) -->
                <?php

	// Render search row
	$Page->resetAttributes();
	$Page->RowType = ROWTYPE_SEARCH;
	$Page->renderRow();
?>
                <form name="fview2rpt" id="fview2rpt" class="form-inline ew-form ew-ext-filter-form"
                    action="<?php echo CurrentPageName() ?>">
                    <?php $searchPanelClass = ($Page->Filter <> "") ? " show" : " show"; ?>
                </form>
                <script>
                fview2rpt.filterList = <?php echo $Page->getFilterList() ?>;
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
                <div class="ew-grid" <?php echo $Page->ReportTableStyle ?>>
                    <?php } else { ?>
                    <div class="card ew-card ew-grid" <?php echo $Page->ReportTableStyle ?>>
                        <?php } ?>
                        <?php } ?>
                        <!-- Report grid (begin) -->
                        <?php if ($Page->Export <> "pdf") { ?>
                        <div id="gmp_view2"
                            class="<?php if (IsResponsiveLayout()) { echo "table-responsive "; } ?>ew-grid-middle-panel">
                            <?php } ?>
                            <table class="<?php echo $Page->ReportTableClass ?>">
                                <thead>
                                    <!-- Table header -->
                                    <tr class="ew-table-header">
                                        <?php if ($Page->idsales_orders->Visible) {
	echo '
	<div style="margin-top:-2rem;"></div>
	<img src="/Stationery_Project/img/bin/logo.png" alt="Gyandeep" style="height: 100px;width: 115px;margin-bottom: -7rem;margin-left: 3rem;margin-top: 3rem;">
	<div style="margin-left: 15rem;">
	<p>
	<h2>Gyandeep Stationery</h2>
	
	Shreeji Chember, Nr.Chachar Chok, Navli Bajar, Liliya-Mota, Amreli (Gujarat) India. <br>
	Email: gyandeepeducation86@gmail.com | Mo: +91 93778 75706
	</p>
	<p style="margin-left: 40rem;margin-right: 5px;margin-top: -2rem;">Date: '.date('d-m-Y'). '</p>
	</div>
	<hr class="bg-dark">
	<center><h2><u>Products Reports</u></h2></center>
	
	'; ?>
                                        <?php if ($Page->Export <> "" || $Page->DrillDown) { ?>
                                        <td data-field="idsales_orders">
                                            <div class="view2_idsales_orders"><span
                                                    class="ew-table-header-caption"><?php echo $Page->idsales_orders->caption() ?></span>
                                            </div>
                                        </td>
                                        <?php } else { ?>
                                        <td data-field="idsales_orders">
                                            <?php if ($Page->sortUrl($Page->idsales_orders) == "") { ?>
                                            <div class="ew-table-header-btn view2_idsales_orders">
                                                <span
                                                    class="ew-table-header-caption"><?php echo $Page->idsales_orders->caption() ?></span>
                                            </div>
                                            <?php } else { ?>
                                            <div class="ew-table-header-btn ew-pointer view2_idsales_orders"
                                                onclick="ew.sort(event,'<?php echo $Page->sortUrl($Page->idsales_orders) ?>',0);">
                                                <span
                                                    class="ew-table-header-caption"><?php echo $Page->idsales_orders->caption() ?></span>
                                                <span
                                                    class="ew-table-header-sort"><?php if ($Page->idsales_orders->getSort() == "ASC") { ?><i
                                                        class="fa fa-sort-up"></i><?php } elseif ($Page->idsales_orders->getSort() == "DESC") { ?><i
                                                        class="fa fa-sort-down"></i><?php } ?></span>
                                            </div>
                                            <?php } ?>
                                        </td>
                                        <?php } ?>
                                        <?php } ?>
                                        <?php if ($Page->order_date->Visible) { ?>
                                        <?php if ($Page->Export <> "" || $Page->DrillDown) { ?>
                                        <td data-field="order_date">
                                            <div class="view2_order_date"><span
                                                    class="ew-table-header-caption"><?php echo $Page->order_date->caption() ?></span>
                                            </div>
                                        </td>
                                        <?php } else { ?>
                                        <td data-field="order_date">
                                            <?php if ($Page->sortUrl($Page->order_date) == "") { ?>
                                            <div class="ew-table-header-btn view2_order_date">
                                                <span
                                                    class="ew-table-header-caption"><?php echo $Page->order_date->caption() ?></span>
                                                <?php if (!$DashboardReport) { ?>
                                                <a class="ew-table-header-popup"
                                                    title="<?php echo $ReportLanguage->phrase("Filter"); ?>"
                                                    onclick="ew.showPopup.call(this, event, { id: 'x_order_date', form: 'fview2rpt', name: 'view2_order_date', range: true, from: '<?php echo $Page->order_date->RangeFrom; ?>', to: '<?php echo $Page->order_date->RangeTo; ?>' });"
                                                    id="x_order_date<?php echo $Page->Counts[0][0]; ?>"><span
                                                        class="icon-filter"></span></a>
                                                <?php } ?>
                                            </div>
                                            <?php } else { ?>
                                            <div class="ew-table-header-btn ew-pointer view2_order_date"
                                                onclick="ew.sort(event,'<?php echo $Page->sortUrl($Page->order_date) ?>',0);">
                                                <span
                                                    class="ew-table-header-caption"><?php echo $Page->order_date->caption() ?></span>
                                                <span
                                                    class="ew-table-header-sort"><?php if ($Page->order_date->getSort() == "ASC") { ?><i
                                                        class="fa fa-sort-up"></i><?php } elseif ($Page->order_date->getSort() == "DESC") { ?><i
                                                        class="fa fa-sort-down"></i><?php } ?></span>
                                                <?php if (!$DashboardReport) { ?>
                                                <a class="ew-table-header-popup"
                                                    title="<?php echo $ReportLanguage->phrase("Filter"); ?>"
                                                    onclick="ew.showPopup.call(this, event, { id: 'x_order_date', form: 'fview2rpt', name: 'view2_order_date', range: true, from: '<?php echo $Page->order_date->RangeFrom; ?>', to: '<?php echo $Page->order_date->RangeTo; ?>' });"
                                                    id="x_order_date<?php echo $Page->Counts[0][0]; ?>"><span
                                                        class="icon-filter"></span></a>
                                                <?php } ?>
                                            </div>
                                            <?php } ?>
                                        </td>
                                        <?php } ?>
                                        <?php } ?>
                                        <?php if ($Page->last_shipping_date->Visible) { ?>
                                        <?php if ($Page->Export <> "" || $Page->DrillDown) { ?>
                                        <td data-field="last_shipping_date">
                                            <div class="view2_last_shipping_date"><span
                                                    class="ew-table-header-caption"><?php echo $Page->last_shipping_date->caption() ?></span>
                                            </div>
                                        </td>
                                        <?php } else { ?>
                                        <td data-field="last_shipping_date">
                                            <?php if ($Page->sortUrl($Page->last_shipping_date) == "") { ?>
                                            <div class="ew-table-header-btn view2_last_shipping_date">
                                                <span
                                                    class="ew-table-header-caption"><?php echo $Page->last_shipping_date->caption() ?></span>
                                            </div>
                                            <?php } else { ?>
                                            <div class="ew-table-header-btn ew-pointer view2_last_shipping_date"
                                                onclick="ew.sort(event,'<?php echo $Page->sortUrl($Page->last_shipping_date) ?>',0);">
                                                <span
                                                    class="ew-table-header-caption"><?php echo $Page->last_shipping_date->caption() ?></span>
                                                <span
                                                    class="ew-table-header-sort"><?php if ($Page->last_shipping_date->getSort() == "ASC") { ?><i
                                                        class="fa fa-sort-up"></i><?php } elseif ($Page->last_shipping_date->getSort() == "DESC") { ?><i
                                                        class="fa fa-sort-down"></i><?php } ?></span>
                                            </div>
                                            <?php } ?>
                                        </td>
                                        <?php } ?>
                                        <?php } ?>
                                        <?php if ($Page->tax_amount->Visible) { ?>
                                        <?php if ($Page->Export <> "" || $Page->DrillDown) { ?>
                                        <td data-field="tax_amount">
                                            <div class="view2_tax_amount"><span
                                                    class="ew-table-header-caption"><?php echo $Page->tax_amount->caption() ?></span>
                                            </div>
                                        </td>
                                        <?php } else { ?>
                                        <td data-field="tax_amount">
                                            <?php if ($Page->sortUrl($Page->tax_amount) == "") { ?>
                                            <div class="ew-table-header-btn view2_tax_amount">
                                                <span
                                                    class="ew-table-header-caption"><?php echo $Page->tax_amount->caption() ?></span>
                                            </div>
                                            <?php } else { ?>
                                            <div class="ew-table-header-btn ew-pointer view2_tax_amount"
                                                onclick="ew.sort(event,'<?php echo $Page->sortUrl($Page->tax_amount) ?>',0);">
                                                <span
                                                    class="ew-table-header-caption"><?php echo $Page->tax_amount->caption() ?></span>
                                                <span
                                                    class="ew-table-header-sort"><?php if ($Page->tax_amount->getSort() == "ASC") { ?><i
                                                        class="fa fa-sort-up"></i><?php } elseif ($Page->tax_amount->getSort() == "DESC") { ?><i
                                                        class="fa fa-sort-down"></i><?php } ?></span>
                                            </div>
                                            <?php } ?>
                                        </td>
                                        <?php } ?>
                                        <?php } ?>
                                        <?php if ($Page->net_amount->Visible) { ?>
                                        <?php if ($Page->Export <> "" || $Page->DrillDown) { ?>
                                        <td data-field="net_amount">
                                            <div class="view2_net_amount"><span
                                                    class="ew-table-header-caption"><?php echo $Page->net_amount->caption() ?></span>
                                            </div>
                                        </td>
                                        <?php } else { ?>
                                        <td data-field="net_amount">
                                            <?php if ($Page->sortUrl($Page->net_amount) == "") { ?>
                                            <div class="ew-table-header-btn view2_net_amount">
                                                <span
                                                    class="ew-table-header-caption"><?php echo $Page->net_amount->caption() ?></span>
                                            </div>
                                            <?php } else { ?>
                                            <div class="ew-table-header-btn ew-pointer view2_net_amount"
                                                onclick="ew.sort(event,'<?php echo $Page->sortUrl($Page->net_amount) ?>',0);">
                                                <span
                                                    class="ew-table-header-caption"><?php echo $Page->net_amount->caption() ?></span>
                                                <span
                                                    class="ew-table-header-sort"><?php if ($Page->net_amount->getSort() == "ASC") { ?><i
                                                        class="fa fa-sort-up"></i><?php } elseif ($Page->net_amount->getSort() == "DESC") { ?><i
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
                                        <td data-field="idsales_orders"
                                            <?php echo $Page->idsales_orders->cellAttributes() ?>>
                                            <span<?php echo $Page->idsales_orders->viewAttributes() ?>>
                                                <?php echo $Page->idsales_orders->getViewValue() ?></span>
                                        </td>
                                        <?php } ?>
                                        <?php if ($Page->order_date->Visible) { ?>
                                        <td data-field="order_date" <?php echo $Page->order_date->cellAttributes() ?>>
                                            <span<?php echo $Page->order_date->viewAttributes() ?>>
                                                <?php echo $Page->order_date->getViewValue() ?></span>
                                        </td>
                                        <?php } ?>
                                        <?php if ($Page->last_shipping_date->Visible) { ?>
                                        <td data-field="last_shipping_date"
                                            <?php echo $Page->last_shipping_date->cellAttributes() ?>>
                                            <span<?php echo $Page->last_shipping_date->viewAttributes() ?>>
                                                <?php echo $Page->last_shipping_date->getViewValue() ?></span>
                                        </td>
                                        <?php } ?>
                                        <?php if ($Page->tax_amount->Visible) { ?>
                                        <td data-field="tax_amount" <?php echo $Page->tax_amount->cellAttributes() ?>>
                                            <span<?php echo $Page->tax_amount->viewAttributes() ?>>
                                                <?php echo $Page->tax_amount->getViewValue() ?></span>
                                        </td>
                                        <?php } ?>
                                        <?php if ($Page->net_amount->Visible) { ?>
                                        <td data-field="net_amount" <?php echo $Page->net_amount->cellAttributes() ?>>
                                            <span<?php echo $Page->net_amount->viewAttributes() ?>>
                                                <?php echo $Page->net_amount->getViewValue() ?></span>
                                        </td>
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
                                <?php } elseif (!$Page->ShowHeader && TRUE) { // No header displayed ?>
                                <?php if ($Page->Export <> "pdf") { ?>
                                <?php if ($Page->Export == "word" || $Page->Export == "excel") { ?>
                                <div class="ew-grid" <?php echo $Page->ReportTableStyle ?>>
                                    <?php } else { ?>
                                    <div class="card ew-card ew-grid" <?php echo $Page->ReportTableStyle ?>>
                                        <?php } ?>
                                        <?php } ?>
                                        <!-- Report grid (begin) -->
                                        <?php if ($Page->Export <> "pdf") { ?>
                                        <div id="gmp_view2"
                                            class="<?php if (IsResponsiveLayout()) { echo "table-responsive "; } ?>ew-grid-middle-panel">
                                            <?php } ?>
                                            <table class="<?php echo $Page->ReportTableClass ?>">
                                                <?php } ?>
                                                <?php if ($Page->TotalGroups > 0 || TRUE) { // Show footer ?>
                                            </table>
                                            <?php if ($Page->Export <> "pdf") { ?>
                                        </div>
                                        <?php } ?>
                                        <?php if ($Page->Export == "" && !($Page->DrillDown && $Page->TotalGroups > 0)) { ?>
                                        <div class="card-footer ew-grid-lower-panel">
                                            <?php include "view2_pager.php" ?>
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