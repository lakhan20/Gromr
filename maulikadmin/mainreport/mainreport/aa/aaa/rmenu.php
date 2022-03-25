<?php
namespace PHPReportMaker12\project1;
?>
<?php
namespace PHPReportMaker12\project1;

// Menu Language
if ($Language && $Language->LanguageFolder == $LANGUAGE_FOLDER)
	$MenuLanguage = &$Language;
else
	$MenuLanguage = new Language();

// Navbar menu
$topMenu = new Menu("navbar", TRUE, TRUE);
echo $topMenu->toScript();

// Sidebar menu
$sideMenu = new Menu("menu", TRUE, FALSE);
$sideMenu->addMenuItem(10, "mi_product", $ReportLanguage->phrase("SimpleReportMenuItemPrefix") . $ReportLanguage->menuPhrase("10", "MenuText") . $ReportLanguage->phrase("SimpleReportMenuItemSuffix"), "productrpt.php", -1, "", TRUE, FALSE, FALSE, "", "", FALSE);
$sideMenu->addMenuItem(19, "mi_user", $ReportLanguage->phrase("SimpleReportMenuItemPrefix") . $ReportLanguage->menuPhrase("19", "MenuText") . $ReportLanguage->phrase("SimpleReportMenuItemSuffix"), "userrpt.php", -1, "", TRUE, FALSE, FALSE, "", "", FALSE);
$sideMenu->addMenuItem(29, "mi_Product_Report_", $ReportLanguage->phrase("DetailSummaryReportMenuItemPrefix") . $ReportLanguage->menuPhrase("29", "MenuText") . $ReportLanguage->phrase("DetailSummaryReportMenuItemSuffix"), "Product_Report_smry.php", -1, "", TRUE, FALSE, FALSE, "", "", FALSE);
$sideMenu->addMenuItem(33, "mi_Order_Report", $ReportLanguage->phrase("DetailSummaryReportMenuItemPrefix") . $ReportLanguage->menuPhrase("33", "MenuText") . $ReportLanguage->phrase("DetailSummaryReportMenuItemSuffix"), "Order_Reportsmry.php", -1, "", TRUE, FALSE, FALSE, "", "", FALSE);
echo $sideMenu->toScript();
?>