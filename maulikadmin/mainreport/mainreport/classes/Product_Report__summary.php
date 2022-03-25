<?php
namespace PHPReportMaker12\project1;

/**
 * Page class (Product_Report__summary)
 */
class Product_Report__summary extends Product_Report_
{

	// Page ID
	public $PageID = 'summary';

	// Project ID
	public $ProjectID = "{AC00DBCA-1394-47B1-9E97-D669E21C45A4}";

	// Page object name
	public $PageObjName = 'Product_Report__summary';
	public $Token = "";
	public $TokenTimeout = 0;
	public $CheckToken = CHECK_TOKEN;

	// Page headings
	public $Heading = '';
	public $Subheading = '';
	public $PageHeader;
	public $PageFooter;

	// Export URLs
	public $ExportPrintUrl;
	public $ExportExcelUrl;
	public $ExportWordUrl;
	public $ExportPdfUrl;
	public $ExportEmailUrl;

	// CSS
	public $ReportTableClass = "";
	public $ReportTableStyle = "";

	// Custom export
	public $ExportPrintCustom = FALSE;
	public $ExportExcelCustom = FALSE;
	public $ExportWordCustom = FALSE;
	public $ExportPdfCustom = FALSE;
	public $ExportEmailCustom = FALSE;

	// Page heading
	public function pageHeading()
	{
		global $ReportLanguage;
		if ($this->Heading <> "")
			return $this->Heading;
		if (method_exists($this, "TableCaption"))
			return $this->tableCaption();
		return "";
	}

	// Page subheading
	public function pageSubheading()
	{
		global $ReportLanguage;
		if ($this->Subheading <> "")
			return $this->Subheading;
		return "";
	}

	// Page name
	public function pageName()
	{
		return CurrentPageName();
	}

	// Page URL
	public function pageUrl()
	{
		$pageUrl = CurrentPageName() . "?";
		if ($this->UseTokenInUrl) $pageUrl .= "t=" . $this->TableVar . "&"; // Add page token
		return $pageUrl;
	}

	// Get message
	public function getMessage()
	{
		return @$_SESSION[SESSION_MESSAGE];
	}

	// Set message
	public function setMessage($v)
	{
		AddMessage($_SESSION[SESSION_MESSAGE], $v);
	}

	// Get failure message
	public function getFailureMessage()
	{
		return @$_SESSION[SESSION_FAILURE_MESSAGE];
	}

	// Set failure message
	public function setFailureMessage($v)
	{
		AddMessage($_SESSION[SESSION_FAILURE_MESSAGE], $v);
	}

	// Get success message
	public function getSuccessMessage()
	{
		return @$_SESSION[SESSION_SUCCESS_MESSAGE];
	}

	// Set success message
	public function setSuccessMessage($v)
	{
		AddMessage($_SESSION[SESSION_SUCCESS_MESSAGE], $v);
	}

	// Get warning message
	public function getWarningMessage()
	{
		return @$_SESSION[SESSION_WARNING_MESSAGE];
	}

	// Set warning message
	public function setWarningMessage($v)
	{
		AddMessage($_SESSION[SESSION_WARNING_MESSAGE], $v);
	}

	// Clear message
	public function clearMessage()
	{
		$_SESSION[SESSION_MESSAGE] = "";
	}

	// Clear failure message
	public function clearFailureMessage()
	{
		$_SESSION[SESSION_FAILURE_MESSAGE] = "";
	}

	// Clear success message
	public function clearSuccessMessage()
	{
		$_SESSION[SESSION_SUCCESS_MESSAGE] = "";
	}

	// Clear warning message
	public function clearWarningMessage()
	{
		$_SESSION[SESSION_WARNING_MESSAGE] = "";
	}

	// Clear messages
	public function clearMessages()
	{
		$_SESSION[SESSION_MESSAGE] = "";
		$_SESSION[SESSION_FAILURE_MESSAGE] = "";
		$_SESSION[SESSION_SUCCESS_MESSAGE] = "";
		$_SESSION[SESSION_WARNING_MESSAGE] = "";
	}

	// Show message
	public function showMessage()
	{
		$hidden = FALSE;
		$html = "";

		// Message
		$message = $this->getMessage();
		if (method_exists($this, "Message_Showing"))
			$this->Message_Showing($message, "");
		if ($message <> "") { // Message in Session, display
			if (!$hidden)
				$message = '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>' . $message;
			$html .= '<div class="alert alert-info alert-dismissible ew-info"><i class="icon fa fa-info"></i>' . $message . '</div>';
			$_SESSION[SESSION_MESSAGE] = ""; // Clear message in Session
		}

		// Warning message
		$warningMessage = $this->getWarningMessage();
		if (method_exists($this, "Message_Showing"))
			$this->Message_Showing($warningMessage, "warning");
		if ($warningMessage <> "") { // Message in Session, display
			if (!$hidden)
				$warningMessage = '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>' . $warningMessage;
			$html .= '<div class="alert alert-warning alert-dismissible ew-warning"><i class="icon fa fa-warning"></i>' . $warningMessage . '</div>';
			$_SESSION[SESSION_WARNING_MESSAGE] = ""; // Clear message in Session
		}

		// Success message
		$successMessage = $this->getSuccessMessage();
		if (method_exists($this, "Message_Showing"))
			$this->Message_Showing($successMessage, "success");
		if ($successMessage <> "") { // Message in Session, display
			if (!$hidden)
				$successMessage = '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>' . $successMessage;
			$html .= '<div class="alert alert-success alert-dismissible ew-success"><i class="icon fa fa-check"></i>' . $successMessage . '</div>';
			$_SESSION[SESSION_SUCCESS_MESSAGE] = ""; // Clear message in Session
		}

		// Failure message
		$errorMessage = $this->getFailureMessage();
		if (method_exists($this, "Message_Showing"))
			$this->Message_Showing($errorMessage, "failure");
		if ($errorMessage <> "") { // Message in Session, display
			if (!$hidden)
				$errorMessage = '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>' . $errorMessage;
			$html .= '<div class="alert alert-danger alert-dismissible ew-error"><i class="icon fa fa-ban"></i>' . $errorMessage . '</div>';
			$_SESSION[SESSION_FAILURE_MESSAGE] = ""; // Clear message in Session
		}
		echo '<div class="ew-message-dialog' . (($hidden) ? ' d-none' : "") . '">' . $html . '</div>';
	}

	// Show Page Header
	public function showPageHeader()
	{
		$header = $this->PageHeader;
		$this->Page_DataRendering($header);
		if ($header <> "") // Header exists, display
			echo '<p id="ew-page-header">' . $header . '</p>';
	}

	// Show Page Footer
	public function showPageFooter()
	{
		$footer = $this->PageFooter;
		$this->Page_DataRendered($footer);
		if ($footer <> "") // Fotoer exists, display
			echo '<p id="ew-page-footer">' . $footer . '</p>';
	}

	// Validate page request
	public function isPageRequest()
	{
		if ($this->UseTokenInUrl) {
			if (IsPost())
				return ($this->TableVar == Post("t"));
			if (Get("t") !== NULL)
				return ($this->TableVar == Get("t"));
		}
		return TRUE;
	}

	// Valid Post
	protected function validPost()
	{
		if (!$this->CheckToken || !IsPost() || IsApi())
			return TRUE;
		if (Post(TOKEN_NAME) === NULL)
			return FALSE;
		$fn = PROJECT_NAMESPACE . CHECK_TOKEN_FUNC;
		if (is_callable($fn))
			return $fn(Post(TOKEN_NAME), $this->TokenTimeout);
		return FALSE;
	}

	// Create Token
	public function createToken()
	{
		global $CurrentToken;
		$fn = PROJECT_NAMESPACE . CREATE_TOKEN_FUNC; // Always create token, required by API file/lookup request
		if ($this->Token == "" && is_callable($fn)) // Create token
			$this->Token = $fn();
		$CurrentToken = $this->Token; // Save to global variable
	}

	// Constructor
	public function __construct()
	{
		global $Language, $ReportLanguage, $DashboardReport;

		// Initialize
		if (!$DashboardReport)
			$GLOBALS["Page"] = &$this;
		$this->TokenTimeout = SessionTimeoutTime();

		// Language object
		$ReportLanguage = new ReportLanguage();
		if ($Language === NULL)
			$Language = $ReportLanguage;

		// Parent constuctor
		parent::__construct();

		// Table object (Product_Report_)
		if (!isset($GLOBALS["Product_Report_"])) {
			$GLOBALS["Product_Report_"] = &$this;
			$GLOBALS["Table"] = &$GLOBALS["Product_Report_"];
		}

		// Initialize URLs
		$this->ExportPrintUrl = $this->pageUrl() . "export=print";
		$this->ExportExcelUrl = $this->pageUrl() . "export=excel";
		$this->ExportWordUrl = $this->pageUrl() . "export=word";
		$this->ExportPdfUrl = $this->pageUrl() . "export=pdf";
		$this->ExportEmailUrl = $this->pageUrl() . "export=email";

		// Page ID
		if (!defined(PROJECT_NAMESPACE . "PAGE_ID"))
			define(PROJECT_NAMESPACE . "PAGE_ID", 'summary');

		// Table name (for backward compatibility)
		if (!defined(PROJECT_NAMESPACE . "TABLE_NAME"))
			define(PROJECT_NAMESPACE . "TABLE_NAME", 'Product Report ');

		// Start timer
		if (!isset($GLOBALS["DebugTimer"]))
			$GLOBALS["DebugTimer"] = new Timer();

		// Debug message
		LoadDebugMessage();

		// Open connection
		if (!isset($GLOBALS["Conn"]))
			$GLOBALS["Conn"] = &$this->getConnection();

		// Export options
		$this->ExportOptions = new ListOptions();
		$this->ExportOptions->Tag = "div";
		$this->ExportOptions->TagClassName = "ew-export-option";

		// Search options
		$this->SearchOptions = new ListOptions();
		$this->SearchOptions->Tag = "div";
		$this->SearchOptions->TagClassName = "ew-search-option";

		// Filter options
		$this->FilterOptions = new ListOptions();
		$this->FilterOptions->Tag = "div";
		$this->FilterOptions->TagClassName = "ew-filter-option fProduct_Report_summary";

		// Generate report options
		$this->GenerateOptions = new ListOptions();
		$this->GenerateOptions->Tag = "div";
		$this->GenerateOptions->TagClassName = "ew-generate-option";
	}

	// Get export HTML tag
	public function getExportTag($type, $custom = FALSE)
	{
		global $ReportLanguage;
		$exportId = session_id();
		if (SameText($type, "excel")) {
			if ($custom)
				return "<a class=\"ew-export-link ew-excel\" title=\"" . HtmlEncode($ReportLanguage->phrase("ExportToExcel", TRUE)) . "\" data-caption=\"" . HtmlEncode($ReportLanguage->phrase("ExportToExcel", TRUE)) . "\" href=\"javascript:void(0);\" onclick=\"ew.exportWithCharts(event, '" . $this->ExportExcelUrl . "', '" . $exportId . "');\">" . $ReportLanguage->phrase("ExportToExcel") . "</a>";
			else
				return "<a class=\"ew-export-link ew-excel\" title=\"" . HtmlEncode($ReportLanguage->phrase("ExportToExcel", TRUE)) . "\" data-caption=\"" . HtmlEncode($ReportLanguage->phrase("ExportToExcel", TRUE)) . "\" href=\"" . $this->ExportExcelUrl . "\">" . $ReportLanguage->phrase("ExportToExcel") . "</a>";
		} elseif (SameText($type, "word")) {
			if ($custom)
				return "<a class=\"ew-export-link ew-word\" title=\"" . HtmlEncode($ReportLanguage->phrase("ExportToWord", TRUE)) . "\" data-caption=\"" . HtmlEncode($ReportLanguage->phrase("ExportToWord", TRUE)) . "\" href=\"javascript:void(0);\" onclick=\"ew.exportWithCharts(event, '" . $this->ExportWordUrl . "', '" . $exportId . "');\">" . $ReportLanguage->phrase("ExportToWord") . "</a>";
			else
				return "<a class=\"ew-export-link ew-word\" title=\"" . HtmlEncode($ReportLanguage->phrase("ExportToWord", TRUE)) . "\" data-caption=\"" . HtmlEncode($ReportLanguage->phrase("ExportToWord", TRUE)) . "\" href=\"" . $this->ExportWordUrl . "\">" . $ReportLanguage->phrase("ExportToWord") . "</a>";
		} elseif (SameText($type, "print")) {
			if ($custom)
				return "<a class=\"ew-export-link ew-print\" title=\"" . HtmlEncode($ReportLanguage->phrase("PrinterFriendly", TRUE)) . "\" data-caption=\"" . HtmlEncode($ReportLanguage->phrase("PrinterFriendly", TRUE)) . "\" href=\"javascript:void(0);\" onclick=\"ew.exportWithCharts(event, '" . $this->ExportPrintUrl . "', '" . $exportId . "');\">" . $ReportLanguage->phrase("PrinterFriendly") . "</a>";
			else
				return "<a class=\"ew-export-link ew-print\" title=\"" . HtmlEncode($ReportLanguage->phrase("PrinterFriendly"), TRUE) . "\" data-caption=\"" . HtmlEncode($ReportLanguage->phrase("PrinterFriendly", TRUE)) . "\" href=\"" . $this->ExportPrintUrl . "\">" . $ReportLanguage->phrase("PrinterFriendly") . "</a>";
		} elseif (SameText($type, "pdf")) {
			return "<a class=\"ew-export-link ew-pdf\" title=\"" . HtmlEncode($ReportLanguage->phrase("ExportToPDF", TRUE)) . "\" data-caption=\"" . HtmlEncode($ReportLanguage->phrase("ExportToPDF", TRUE)) . "\" href=\"" . $this->ExportPdfUrl . "\">" . $ReportLanguage->phrase("ExportToPDF") . "</a>";
		} elseif (SameText($type, "email")) {
			return "<a class=\"ew-export-link ew-email\" title=\"" . HtmlEncode($ReportLanguage->phrase("ExportToEmail", TRUE)) . "\" data-caption=\"" . HtmlEncode($ReportLanguage->phrase("ExportToEmail", TRUE)) . "\" id=\"emf_Product_Report_\" href=\"#\" onclick=\"ew.emailDialogShow({ lnk: 'emf_Product_Report_', hdr: ew.language.phrase('ExportToEmail'), url: '$this->ExportEmailUrl', exportid: '$exportId', el: this }); return false;\">" . $ReportLanguage->phrase("ExportToEmail") . "</a>";
		}
	}

	// Set up export options
	protected function setupExportOptions()
	{
		global $Security, $ReportLanguage, $ReportOptions;
		$exportId = session_id();
		$reportTypes = [];

		// Printer friendly
		$item = &$this->ExportOptions->add("print");
		$item->Body = $this->getExportTag("print");
		$item->Visible = TRUE;
		$reportTypes["print"] = $item->Visible ? $ReportLanguage->phrase("ReportFormPrint") : "";

		// Export to Excel
		$item = &$this->ExportOptions->add("excel");
		$item->Body = $this->getExportTag("excel");
		$item->Visible = FALSE;
		$reportTypes["excel"] = $item->Visible ? $ReportLanguage->phrase("ReportFormExcel") : "";

		// Export to Word
		$item = &$this->ExportOptions->add("word");
		$item->Body = $this->getExportTag("word");
		$item->Visible = FALSE;
		$reportTypes["word"] = $item->Visible ? $ReportLanguage->phrase("ReportFormWord") : "";

		// Export to Pdf
		$item = &$this->ExportOptions->add("pdf");
		$item->Body = $this->getExportTag("pdf");
		$item->Visible = FALSE;
		$item->Visible = FALSE;
		$reportTypes["pdf"] = $item->Visible ? $ReportLanguage->phrase("ReportFormPdf") : "";

		// Export to Email
		$item = &$this->ExportOptions->add("email");
		$item->Body = $this->getExportTag("email");
		$item->Visible = FALSE;
		$reportTypes["email"] = $item->Visible ? $ReportLanguage->phrase("ReportFormEmail") : "";

		// Report types
		$ReportOptions["ReportTypes"] = $reportTypes;

		// Drop down button for export
		$this->ExportOptions->UseDropDownButton = FALSE;
		$this->ExportOptions->UseButtonGroup = TRUE;
		$this->ExportOptions->UseImageAndText = $this->ExportOptions->UseDropDownButton;
		$this->ExportOptions->DropDownButtonPhrase = $ReportLanguage->phrase("ButtonExport");

		// Add group option item
		$item = &$this->ExportOptions->add($this->ExportOptions->GroupOptionName);
		$item->Body = "";
		$item->Visible = FALSE;

		// Filter button
		$item = &$this->FilterOptions->add("savecurrentfilter");
		$item->Body = "<a class=\"ew-save-filter\" data-form=\"fProduct_Report_summary\" href=\"#\">" . $ReportLanguage->phrase("SaveCurrentFilter") . "</a>";
		$item->Visible = TRUE;
		$item = &$this->FilterOptions->add("deletefilter");
		$item->Body = "<a class=\"ew-delete-filter\" data-form=\"fProduct_Report_summary\" href=\"#\">" . $ReportLanguage->phrase("DeleteFilter") . "</a>";
		$item->Visible = TRUE;
		$this->FilterOptions->UseDropDownButton = TRUE;
		$this->FilterOptions->UseButtonGroup = !$this->FilterOptions->UseDropDownButton; // v8
		$this->FilterOptions->DropDownButtonPhrase = $ReportLanguage->phrase("Filters");

		// Add group option item
		$item = &$this->FilterOptions->add($this->FilterOptions->GroupOptionName);
		$item->Body = "";
		$item->Visible = FALSE;

		// Set up export options (extended)
		$this->setupExportOptionsExt();

		// Hide options for export
		if ($this->isExport()) {
			$this->ExportOptions->hideAllOptions();
			$this->FilterOptions->hideAllOptions();
		}

		// Set up table class
		if ($this->isExport("word") || $this->isExport("excel") || $this->isExport("pdf"))
			$this->ReportTableClass = "ew-table";
		else
			$this->ReportTableClass = "table ew-table";
	}

	// Set up search options
	protected function setupSearchOptions()
	{
		global $ReportLanguage;

		// Filter panel button
		$item = &$this->SearchOptions->add("searchtoggle");
		$searchToggleClass = $this->FilterApplied ? " active" : " active";
		$item->Body = "<button type=\"button\" class=\"btn btn-default ew-search-toggle" . $searchToggleClass . "\" title=\"" . $ReportLanguage->phrase("SearchBtn", TRUE) . "\" data-caption=\"" . $ReportLanguage->phrase("SearchBtn", TRUE) . "\" data-toggle=\"button\" data-form=\"fProduct_Report_summary\">" . $ReportLanguage->phrase("SearchBtn") . "</button>";
		$item->Visible = TRUE;

		// Reset filter
		$item = &$this->SearchOptions->add("resetfilter");
		$item->Body = "<button type=\"button\" class=\"btn btn-default\" title=\"" . HtmlEncode($ReportLanguage->phrase("ResetAllFilter", TRUE)) . "\" data-caption=\"" . HtmlEncode($ReportLanguage->phrase("ResetAllFilter", TRUE)) . "\" onclick=\"location='" . CurrentPageName() . "?cmd=reset'\">" . $ReportLanguage->phrase("ResetAllFilter") . "</button>";
		$item->Visible = TRUE && $this->FilterApplied;

		// Button group for reset filter
		$this->SearchOptions->UseButtonGroup = TRUE;

		// Add group option item
		$item = &$this->SearchOptions->add($this->SearchOptions->GroupOptionName);
		$item->Body = "";
		$item->Visible = FALSE;

		// Hide options for export
		if ($this->isExport())
			$this->SearchOptions->hideAllOptions();
	}

	// Terminate page
	public function terminate($url = "")
	{
		global $ReportLanguage, $EXPORT_REPORT, $ExportFileName, $DashboardReport;

		// Page Unload event
		$this->Page_Unload();

		// Global Page Unloaded event (in userfn*.php)
		Page_Unloaded();

		// Export
		if ($this->isExport() && array_key_exists($this->Export, $EXPORT_REPORT)) {
			$content = ob_get_contents();
			if (ob_get_length())
				ob_end_clean();

			// Remove all <div data-tagid="..." id="orig..." class="hide">...</div> (for customviewtag export, except "googlemaps")
			if (preg_match_all('/<div\s+data-tagid=[\'"]([\s\S]*?)[\'"]\s+id=[\'"]orig([\s\S]*?)[\'"]\s+class\s*=\s*[\'"]hide[\'"]>([\s\S]*?)<\/div\s*>/i', $content, $divmatches, PREG_SET_ORDER)) {
				foreach ($divmatches as $divmatch) {
					if ($divmatch[1] <> "googlemaps")
						$content = str_replace($divmatch[0], "", $content);
				}
			}
			$fn = $EXPORT_REPORT[$this->Export];
			$saveResponse = $this->$fn($content);
			if (ReportParam("generaterequest") === TRUE) { // Generate report request
				$this->writeGenResponse($saveResponse);
				$url = ""; // Avoid redirect
			}
		}

		// Close connection if not in dashboard
		if (!$DashboardReport)
			CloseConnections();

		// Go to URL if specified
		if ($url <> "") {
			if (!DEBUG_ENABLED && ob_get_length())
				ob_end_clean();
			SaveDebugMessage();
			header("Location: " . $url);
		}
		if (!$DashboardReport)
			exit();
	}

	// Initialize common variables
	public $ExportOptions; // Export options
	public $SearchOptions; // Search options
	public $FilterOptions; // Filter options

	// Recordset
	public $GroupRecordset = NULL;
	public $Recordset = NULL;
	public $DetailRecordCount = 0;

	// Paging variables
	public $RecordIndex = 0; // Record index
	public $RecordCount = 0; // Record count
	public $StartGroup = 0; // Start group
	public $StopGroup = 0; // Stop group
	public $TotalGroups = 0; // Total groups
	public $GroupCount = 0; // Group count
	public $GroupCounter = []; // Group counter
	public $DisplayGroups = 3; // Groups per page
	public $GroupRange = 10;
	public $Sort = "";
	public $Filter = "";
	public $PageFirstGroupFilter = "";
	public $UserIDFilter = "";
	public $DrillDown = FALSE;
	public $DrillDownInPanel = FALSE;
	public $DrillDownList = "";

	// Clear field for ext filter
	public $ExpiredExtendedFilter = "";
	public $PopupName = "";
	public $PopupValue = "";
	public $FilterApplied;
	public $SearchCommand = FALSE;
	public $ShowHeader;
	public $GroupColumnCount = 0;
	public $SubGroupColumnCount = 0;
	public $DetailColumnCount = 0;
	public $Counts;
	public $Columns;
	public $Values;
	public $Summaries;
	public $Minimums;
	public $Maximums;
	public $GrandCounts;
	public $GrandSummaries;
	public $GrandMinimums;
	public $GrandMaximums;
	public $TotalCount;
	public $GrandSummarySetup = FALSE;
	public $GroupIndexes;
	public $DetailRows = [];
	public $TopContentClass = "col-sm-12 ew-top";
	public $LeftContentClass = "ew-left";
	public $CenterContentClass = "col-sm-12 ew-center";
	public $RightContentClass = "ew-right";
	public $BottomContentClass = "col-sm-12 ew-bottom";

	//
	// Page run
	//

	public function run()
	{
		global $ExportType, $ExportFileName, $ReportLanguage, $Security, $UserProfile,
			$Security, $FormError, $DrillDownInPanel, $Breadcrumb, $ReportLanguage,
			$DashboardReport, $CustomExportType;
		global $ReportLanguage;

		// Get export parameters
		if (ReportParam("export") !== NULL)
			$this->Export = strtolower(ReportParam("export"));
		$ExportType = $this->Export; // Get export parameter, used in header
		$ExportFileName = $this->TableVar; // Get export file, used in header

		// Setup placeholder
		// Setup export options

		$this->setupExportOptions();

		// Global Page Loading event (in userfn*.php)
		Page_Loading();

		// Page Load event
		$this->Page_Load();

		// Check token
		if (!$this->validPost()) {
			echo $ReportLanguage->phrase("InvalidPostRequest");
			$this->terminate();
			exit();
		}

		// Create Token
		$this->createToken();

		// Set up lookup cache
		$this->setupLookupOptions($this->pname);
		$this->setupLookupOptions($this->brand);
		$this->setupLookupOptions($this->bussiness_name);
		$this->setupLookupOptions($this->categoryname);
		$this->setupLookupOptions($this->subcategoryname);

		// Set field visibility for detail fields
		$this->idproduct->setVisibility();
		$this->pname->setVisibility();
		$this->brand->setVisibility();
		$this->MRP->setVisibility();
		$this->price->setVisibility();
		$this->description->setVisibility();

		// Aggregate variables
		// 1st dimension = no of groups (level 0 used for grand total)
		// 2nd dimension = no of fields

		$fieldCount = 7;
		$groupCount = 4;
		$this->Values = &InitArray($fieldCount, 0);
		$this->Counts = &Init2DArray($groupCount, $fieldCount, 0);
		$this->Summaries = &Init2DArray($groupCount, $fieldCount, 0);
		$this->Minimums = &Init2DArray($groupCount, $fieldCount, NULL);
		$this->Maximums = &Init2DArray($groupCount, $fieldCount, NULL);
		$this->GrandCounts = &InitArray($fieldCount, 0);
		$this->GrandSummaries = &InitArray($fieldCount, 0);
		$this->GrandMinimums = &InitArray($fieldCount, NULL);
		$this->GrandMaximums = &InitArray($fieldCount, NULL);

		// Set up array if accumulation required: [Accum, SkipNullOrZero]
		$this->Columns = [[FALSE, FALSE], [FALSE,FALSE], [FALSE,FALSE], [FALSE,FALSE], [FALSE,FALSE], [FALSE,FALSE], [FALSE,FALSE]];

		// Set up groups per page dynamically
		$this->setupDisplayGroups();

		// Set up Breadcrumb
		if (!$this->isExport())
			$this->setupBreadcrumb();

		// Check if search command
		$this->SearchCommand = (Get("cmd", "") == "search");

		// Load default filter values
		$this->loadDefaultFilters();

		// Load custom filters
		$this->Page_FilterLoad();

		// Set up popup filter
		$this->setupPopup();

		// Load group db values if necessary
		$this->loadGroupDbValues();

		// Extended filter
		$extendedFilter = "";

		// Restore filter list
		$this->restoreFilterList();

		// Build extended filter
		$extendedFilter = $this->getExtendedFilter();
		AddFilter($this->Filter, $extendedFilter);

		// Build popup filter
		$popupFilter = $this->getPopupFilter();
		AddFilter($this->Filter, $popupFilter);

		// Check if filter applied
		$this->FilterApplied = $this->checkFilter();

		// Call Page Selecting event
		$this->Page_Selecting($this->Filter);

		// Search options
		$this->setupSearchOptions();

		// Get sort
		$this->Sort = $this->getSort();

		// Get total group count
		$sql = BuildReportSql($this->getSqlSelectGroup(), $this->getSqlWhere(), $this->getSqlGroupBy(), $this->getSqlHaving(), "", $this->Filter, "");
		$this->TotalGroups = $this->getRecordCount($sql);
		if ($this->DisplayGroups <= 0 || $this->DrillDown || $DashboardReport) // Display all groups
			$this->DisplayGroups = $this->TotalGroups;
		$this->StartGroup = 1;

		// Show header
		$this->ShowHeader = ($this->TotalGroups > 0);

		// Set up start position if not export all
		if ($this->ExportAll && $this->isExport())
			$this->DisplayGroups = $this->TotalGroups;
		else
			$this->setupStartGroup();

		// Set no record found message
		if ($this->TotalGroups == 0) {
				if ($this->Filter == "0=101") {
					$this->setWarningMessage($ReportLanguage->phrase("EnterSearchCriteria"));
				} else {
					$this->setWarningMessage($ReportLanguage->phrase("NoRecord"));
				}
		}

		// Hide export options if export/dashboard report
		if ($this->isExport() || $DashboardReport)
			$this->ExportOptions->hideAllOptions();

		// Hide search/filter options if export/drilldown/dashboard report
		if ($this->isExport() || $this->DrillDown || $DashboardReport) {
			$this->SearchOptions->hideAllOptions();
			$this->FilterOptions->hideAllOptions();
			$this->GenerateOptions->hideAllOptions();
		}

		// Get current page groups
		$grpSort = UpdateSortFields($this->getSqlOrderByGroup(), $this->Sort, 2); // Get grouping field only
		$sql = BuildReportSql($this->getSqlSelectGroup(), $this->getSqlWhere(), $this->getSqlGroupBy(), $this->getSqlHaving(), $this->getSqlOrderByGroup(), $this->Filter, $grpSort);
		$this->GroupRecordset = $this->getRecordset($sql, $this->DisplayGroups, $this->StartGroup - 1);

		// Init detail recordset
		$this->Recordset = NULL;
		$this->setupFieldCount();
	}

	// Get summary count
	public function getSummaryCount($lvl, $curValue = TRUE)
	{
		$cnt = 0;
		foreach ($this->DetailRows as $row) {
			$wrkbussiness_name = $row["bussiness_name"];
			$wrkcategoryname = $row["categoryname"];
			$wrksubcategoryname = $row["subcategoryname"];
			if ($lvl >= 1) {
				$val = $curValue ? $this->bussiness_name->CurrentValue : $this->bussiness_name->OldValue;
				$grpval = $curValue ? $this->bussiness_name->groupValue() : $this->bussiness_name->groupOldValue();
				if ($val === NULL && $wrkbussiness_name !== NULL || $val !== NULL && $wrkbussiness_name === NULL ||
					$grpval <> $this->bussiness_name->getGroupValueBase($wrkbussiness_name))
				continue;
			}
			if ($lvl >= 2) {
				$val = $curValue ? $this->categoryname->CurrentValue : $this->categoryname->OldValue;
				$grpval = $curValue ? $this->categoryname->groupValue() : $this->categoryname->groupOldValue();
				if ($val === NULL && $wrkcategoryname !== NULL || $val !== NULL && $wrkcategoryname === NULL ||
					$grpval <> $this->categoryname->getGroupValueBase($wrkcategoryname))
				continue;
			}
			if ($lvl >= 3) {
				$val = $curValue ? $this->subcategoryname->CurrentValue : $this->subcategoryname->OldValue;
				$grpval = $curValue ? $this->subcategoryname->groupValue() : $this->subcategoryname->groupOldValue();
				if ($val === NULL && $wrksubcategoryname !== NULL || $val !== NULL && $wrksubcategoryname === NULL ||
					$grpval <> $this->subcategoryname->getGroupValueBase($wrksubcategoryname))
				continue;
			}
			$cnt++;
		}
		return $cnt;
	}

	// Check level break
	public function checkLevelBreak($lvl)
	{
		switch ($lvl) {
			case 1:
				return ($this->bussiness_name->CurrentValue === NULL && $this->bussiness_name->OldValue !== NULL) ||
					($this->bussiness_name->CurrentValue !== NULL && $this->bussiness_name->OldValue === NULL) ||
					($this->bussiness_name->groupValue() <> $this->bussiness_name->groupOldValue());
			case 2:
				return ($this->categoryname->CurrentValue === NULL && $this->categoryname->OldValue !== NULL) ||
					($this->categoryname->CurrentValue !== NULL && $this->categoryname->OldValue === NULL) ||
					($this->categoryname->groupValue() <> $this->categoryname->groupOldValue()) || $this->checkLevelBreak(1); // Recurse upper level
			case 3:
				return ($this->subcategoryname->CurrentValue === NULL && $this->subcategoryname->OldValue !== NULL) ||
					($this->subcategoryname->CurrentValue !== NULL && $this->subcategoryname->OldValue === NULL) ||
					($this->subcategoryname->groupValue() <> $this->subcategoryname->groupOldValue()) || $this->checkLevelBreak(2); // Recurse upper level
		}
	}

	// Accummulate summary
	public function accumulateSummary()
	{
		$cntx = count($this->Summaries);
		for ($ix = 0; $ix < $cntx; $ix++) {
			$cnty = count($this->Summaries[$ix]);
			for ($iy = 1; $iy < $cnty; $iy++) {
				if ($this->Columns[$iy][0]) { // Accumulate required
					$valwrk = $this->Values[$iy];
					if ($valwrk === NULL) {
						if (!$this->Columns[$iy][1])
							$this->Counts[$ix][$iy]++;
					} else {
						$accum = (!$this->Columns[$iy][1] || !is_numeric($valwrk) || $valwrk <> 0);
						if ($accum) {
							$this->Counts[$ix][$iy]++;
							if (is_numeric($valwrk)) {
								$this->Summaries[$ix][$iy] += $valwrk;
								if ($this->Minimums[$ix][$iy] === NULL) {
									$this->Minimums[$ix][$iy] = $valwrk;
									$this->Maximums[$ix][$iy] = $valwrk;
								} else {
									if ($this->Minimums[$ix][$iy] > $valwrk)
										$this->Minimums[$ix][$iy] = $valwrk;
									if ($this->Maximums[$ix][$iy] < $valwrk)
										$this->Maximums[$ix][$iy] = $valwrk;
								}
							}
						}
					}
				}
			}
		}
		$cntx = count($this->Summaries);
		for ($ix = 0; $ix < $cntx; $ix++)
			$this->Counts[$ix][0]++;
	}

	// Reset level summary
	public function resetLevelSummary($lvl)
	{

		// Clear summary values
		$cntx = count($this->Summaries);
		for ($ix = $lvl; $ix < $cntx; $ix++) {
			$cnty = count($this->Summaries[$ix]);
			for ($iy = 1; $iy < $cnty; $iy++) {
				$this->Counts[$ix][$iy] = 0;
				if ($this->Columns[$iy][0]) {
					$this->Summaries[$ix][$iy] = 0;
					$this->Minimums[$ix][$iy] = NULL;
					$this->Maximums[$ix][$iy] = NULL;
				}
			}
		}
		$cntx = count($this->Summaries);
		for ($ix = $lvl; $ix < $cntx; $ix++)
			$this->Counts[$ix][0] = 0;

		// Reset record count
		$this->RecordCount = 0;
	}

	// Load group row values
	public function loadGroupRowValues($firstRow = FALSE)
	{
		if (!$this->GroupRecordset)
			return;
		if ($firstRow) // Get first group

			//$this->GroupRecordset->moveFirst(); // NOTE: no need to move position
			$this->bussiness_name->setDbValue(""); // Init first value
		else // Get next group
			$this->GroupRecordset->moveNext();
		if (!$this->GroupRecordset->EOF)
			$this->bussiness_name->setDbValue($this->GroupRecordset->fields[0]);
		else
			$this->bussiness_name->setDbValue("");
	}

	// Load row values
	public function loadRowValues($firstRow = FALSE)
	{
		if (!$this->Recordset)
			return;
		if ($firstRow) { // Get first row
			$this->Recordset->moveFirst(); // Move first
			if ($this->GroupCount == 1) {
				$this->FirstRowData = [];
				$this->FirstRowData["idproduct"] = $this->Recordset->fields('idproduct');
				$this->FirstRowData["pname"] = $this->Recordset->fields('pname');
				$this->FirstRowData["brand"] = $this->Recordset->fields('brand');
				$this->FirstRowData["MRP"] = $this->Recordset->fields('MRP');
				$this->FirstRowData["price"] = $this->Recordset->fields('price');
				$this->FirstRowData["bussiness_name"] = $this->Recordset->fields('bussiness_name');
				$this->FirstRowData["email_id"] = $this->Recordset->fields('email_id');
				$this->FirstRowData["categoryname"] = $this->Recordset->fields('categoryname');
				$this->FirstRowData["subcategoryname"] = $this->Recordset->fields('subcategoryname');
			}
		} else { // Get next row
			$this->Recordset->moveNext();
		}
		if (!$this->Recordset->EOF) {
			$this->idproduct->setDbValue($this->Recordset->fields('idproduct'));
			$this->pname->setDbValue($this->Recordset->fields('pname'));
			$this->brand->setDbValue($this->Recordset->fields('brand'));
			$this->MRP->setDbValue($this->Recordset->fields('MRP'));
			$this->price->setDbValue($this->Recordset->fields('price'));
			$this->description->setDbValue($this->Recordset->fields('description'));
			if (!$firstRow) {
				if (is_array($this->bussiness_name->GroupDbValues))
					$this->bussiness_name->setDbValue(@$this->bussiness_name->GroupDbValues[$this->Recordset->fields('bussiness_name')]);
				else
					$this->bussiness_name->setDbValue(GroupValue($this->bussiness_name, $this->Recordset->fields('bussiness_name')));
			}
			$this->email_id->setDbValue($this->Recordset->fields('email_id'));
			$this->categoryname->setDbValue($this->Recordset->fields('categoryname'));
			$this->subcategoryname->setDbValue($this->Recordset->fields('subcategoryname'));
			$this->Values[1] = $this->idproduct->CurrentValue;
			$this->Values[2] = $this->pname->CurrentValue;
			$this->Values[3] = $this->brand->CurrentValue;
			$this->Values[4] = $this->MRP->CurrentValue;
			$this->Values[5] = $this->price->CurrentValue;
			$this->Values[6] = $this->description->CurrentValue;
		} else {
			$this->idproduct->setDbValue("");
			$this->pname->setDbValue("");
			$this->brand->setDbValue("");
			$this->MRP->setDbValue("");
			$this->price->setDbValue("");
			$this->description->setDbValue("");
			$this->bussiness_name->setDbValue("");
			$this->email_id->setDbValue("");
			$this->categoryname->setDbValue("");
			$this->subcategoryname->setDbValue("");
		}
	}

	// Render row
	public function renderRow()
	{
		global $Security, $ReportLanguage, $Language;
		$conn = &$this->getConnection();
		if (!$this->GrandSummarySetup) { // Get Grand total
			$hasCount = FALSE;
			$hasSummary = FALSE;

			// Get total count from SQL directly
			$sql = BuildReportSql($this->getSqlSelectCount(), $this->getSqlWhere(), $this->getSqlGroupBy(), $this->getSqlHaving(), "", $this->Filter, "");
			$rstot = $conn->execute($sql);
			if ($rstot) {
				$this->TotalCount = ($rstot->recordCount() > 1) ? $rstot->recordCount() : $rstot->fields[0];
				$rstot->close();
				$hasCount = TRUE;
			} else {
				$this->TotalCount = 0;
			}
			$hasSummary = TRUE;

			// Accumulate grand summary from detail records
			if (!$hasCount || !$hasSummary) {
				$sql = BuildReportSql($this->getSqlSelect(), $this->getSqlWhere(), $this->getSqlGroupBy(), $this->getSqlHaving(), "", $this->Filter, "");
				$this->Recordset = $conn->execute($sql);
				if ($this->Recordset) {
					$this->loadRowValues(TRUE);
					while (!$this->Recordset->EOF) {
						$this->accumulateGrandSummary();
						$this->loadRowValues();
					}
					$this->Recordset->close();
				}
			}
			$this->GrandSummarySetup = TRUE; // No need to set up again
		}

		// Call Row_Rendering event
		$this->Row_Rendering();
		if ($this->RowType == ROWTYPE_SEARCH) { // Search row
			$ar = [];
			if (is_array($this->pname->AdvancedFilters)) {
				foreach ($this->pname->AdvancedFilters as $filter)
					if ($filter->Enabled)
						$ar[] = [$filter->ID, $filter->Name];
			}
			if (is_array($this->pname->DropDownList)) {
				foreach ($this->pname->DropDownList as $val)
					$ar[] = [$val, GetDropDownDisplayValue($val, "", 0)];
			}
			$this->pname->EditValue = $ar;
			$this->pname->AdvancedSearch->SearchValue = is_array($this->pname->DropDownValue) ? implode(",", $this->pname->DropDownValue) : $this->pname->DropDownValue;
			$ar = [];
			if (is_array($this->brand->AdvancedFilters)) {
				foreach ($this->brand->AdvancedFilters as $filter)
					if ($filter->Enabled)
						$ar[] = [$filter->ID, $filter->Name];
			}
			if (is_array($this->brand->DropDownList)) {
				foreach ($this->brand->DropDownList as $val)
					$ar[] = [$val, GetDropDownDisplayValue($val, "", 0)];
			}
			$this->brand->EditValue = $ar;
			$this->brand->AdvancedSearch->SearchValue = is_array($this->brand->DropDownValue) ? implode(",", $this->brand->DropDownValue) : $this->brand->DropDownValue;
			$ar = [];
			if (is_array($this->bussiness_name->AdvancedFilters)) {
				foreach ($this->bussiness_name->AdvancedFilters as $filter)
					if ($filter->Enabled)
						$ar[] = [$filter->ID, $filter->Name];
			}
			if (is_array($this->bussiness_name->DropDownList)) {
				foreach ($this->bussiness_name->DropDownList as $val)
					$ar[] = [$val, GetDropDownDisplayValue($val, "", 0)];
			}
			$this->bussiness_name->EditValue = $ar;
			$this->bussiness_name->AdvancedSearch->SearchValue = is_array($this->bussiness_name->DropDownValue) ? implode(",", $this->bussiness_name->DropDownValue) : $this->bussiness_name->DropDownValue;
			$ar = [];
			if (is_array($this->categoryname->AdvancedFilters)) {
				foreach ($this->categoryname->AdvancedFilters as $filter)
					if ($filter->Enabled)
						$ar[] = [$filter->ID, $filter->Name];
			}
			if (is_array($this->categoryname->DropDownList)) {
				foreach ($this->categoryname->DropDownList as $val)
					$ar[] = [$val, GetDropDownDisplayValue($val, "", 0)];
			}
			$this->categoryname->EditValue = $ar;
			$this->categoryname->AdvancedSearch->SearchValue = is_array($this->categoryname->DropDownValue) ? implode(",", $this->categoryname->DropDownValue) : $this->categoryname->DropDownValue;
			$ar = [];
			if (is_array($this->subcategoryname->AdvancedFilters)) {
				foreach ($this->subcategoryname->AdvancedFilters as $filter)
					if ($filter->Enabled)
						$ar[] = [$filter->ID, $filter->Name];
			}
			if (is_array($this->subcategoryname->DropDownList)) {
				foreach ($this->subcategoryname->DropDownList as $val)
					$ar[] = [$val, GetDropDownDisplayValue($val, "", 0)];
			}
			$this->subcategoryname->EditValue = $ar;
			$this->subcategoryname->AdvancedSearch->SearchValue = is_array($this->subcategoryname->DropDownValue) ? implode(",", $this->subcategoryname->DropDownValue) : $this->subcategoryname->DropDownValue;
		} elseif ($this->RowType == ROWTYPE_TOTAL && !($this->RowTotalType == ROWTOTAL_GROUP && $this->RowTotalSubType == ROWTOTAL_HEADER)) { // Summary row
			PrependClass($this->RowAttrs["class"], ($this->RowTotalType == ROWTOTAL_PAGE || $this->RowTotalType == ROWTOTAL_GRAND) ? "ew-rpt-grp-aggregate" : ""); // Set up row class
			if ($this->RowTotalType == ROWTOTAL_GROUP) $this->RowAttrs["data-group"] = $this->bussiness_name->groupOldValue(); // Set up group attribute
			if ($this->RowTotalType == ROWTOTAL_GROUP && $this->RowGroupLevel >= 2) $this->RowAttrs["data-group-2"] = $this->categoryname->groupOldValue(); // Set up group attribute 2
			if ($this->RowTotalType == ROWTOTAL_GROUP && $this->RowGroupLevel >= 3) $this->RowAttrs["data-group-3"] = $this->subcategoryname->groupOldValue(); // Set up group attribute 3

			// bussiness_name
			$this->bussiness_name->GroupViewValue = $this->bussiness_name->groupOldValue();
			$this->bussiness_name->CellAttrs["class"] = ($this->RowGroupLevel == 1 ? "ew-rpt-grp-summary-1" : "ew-rpt-grp-field-1");
			$this->bussiness_name->GroupViewValue = DisplayGroupValue($this->bussiness_name, $this->bussiness_name->GroupViewValue);
			$this->bussiness_name->GroupSummaryOldValue = $this->bussiness_name->GroupSummaryValue;
			$this->bussiness_name->GroupSummaryValue = $this->bussiness_name->GroupViewValue;
			$this->bussiness_name->GroupSummaryViewValue = ($this->bussiness_name->GroupSummaryOldValue <> $this->bussiness_name->GroupSummaryValue) ? $this->bussiness_name->GroupSummaryValue : "&nbsp;";

			// categoryname
			$this->categoryname->GroupViewValue = $this->categoryname->groupOldValue();
			$this->categoryname->CellAttrs["class"] = ($this->RowGroupLevel == 2 ? "ew-rpt-grp-summary-2" : "ew-rpt-grp-field-2");
			$this->categoryname->GroupViewValue = DisplayGroupValue($this->categoryname, $this->categoryname->GroupViewValue);
			$this->categoryname->GroupSummaryOldValue = $this->categoryname->GroupSummaryValue;
			$this->categoryname->GroupSummaryValue = $this->categoryname->GroupViewValue;
			$this->categoryname->GroupSummaryViewValue = ($this->categoryname->GroupSummaryOldValue <> $this->categoryname->GroupSummaryValue) ? $this->categoryname->GroupSummaryValue : "&nbsp;";

			// subcategoryname
			$this->subcategoryname->GroupViewValue = $this->subcategoryname->groupOldValue();
			$this->subcategoryname->CellAttrs["class"] = ($this->RowGroupLevel == 3 ? "ew-rpt-grp-summary-3" : "ew-rpt-grp-field-3");
			$this->subcategoryname->GroupViewValue = DisplayGroupValue($this->subcategoryname, $this->subcategoryname->GroupViewValue);
			$this->subcategoryname->GroupSummaryOldValue = $this->subcategoryname->GroupSummaryValue;
			$this->subcategoryname->GroupSummaryValue = $this->subcategoryname->GroupViewValue;
			$this->subcategoryname->GroupSummaryViewValue = ($this->subcategoryname->GroupSummaryOldValue <> $this->subcategoryname->GroupSummaryValue) ? $this->subcategoryname->GroupSummaryValue : "&nbsp;";

			// bussiness_name
			$this->bussiness_name->HrefValue = "";

			// categoryname
			$this->categoryname->HrefValue = "";

			// subcategoryname
			$this->subcategoryname->HrefValue = "";

			// idproduct
			$this->idproduct->HrefValue = "";

			// pname
			$this->pname->HrefValue = "";

			// brand
			$this->brand->HrefValue = "";

			// MRP
			$this->MRP->HrefValue = "";

			// price
			$this->price->HrefValue = "";

			// description
			$this->description->HrefValue = "";
		} else {
			if ($this->RowTotalType == ROWTOTAL_GROUP && $this->RowTotalSubType == ROWTOTAL_HEADER) {
			$this->RowAttrs["data-group"] = $this->bussiness_name->groupValue(); // Set up group attribute
			if ($this->RowGroupLevel >= 2) $this->RowAttrs["data-group-2"] = $this->categoryname->groupValue(); // Set up group attribute 2
			if ($this->RowGroupLevel >= 3) $this->RowAttrs["data-group-3"] = $this->subcategoryname->groupValue(); // Set up group attribute 3
			} else {
			$this->RowAttrs["data-group"] = $this->bussiness_name->groupValue(); // Set up group attribute
			$this->RowAttrs["data-group-2"] = $this->categoryname->groupValue(); // Set up group attribute 2
			$this->RowAttrs["data-group-3"] = $this->subcategoryname->groupValue(); // Set up group attribute 3
			}

			// bussiness_name
			$this->bussiness_name->GroupViewValue = $this->bussiness_name->groupValue();
			$this->bussiness_name->CellAttrs["class"] = "ew-rpt-grp-field-1";
			$this->bussiness_name->GroupViewValue = DisplayGroupValue($this->bussiness_name, $this->bussiness_name->GroupViewValue);
			if ($this->bussiness_name->groupValue() == $this->bussiness_name->groupOldValue() && !$this->checkLevelBreak(1))
				$this->bussiness_name->GroupViewValue = "&nbsp;";

			// categoryname
			$this->categoryname->GroupViewValue = $this->categoryname->groupValue();
			$this->categoryname->CellAttrs["class"] = "ew-rpt-grp-field-2";
			$this->categoryname->GroupViewValue = DisplayGroupValue($this->categoryname, $this->categoryname->GroupViewValue);
			if ($this->categoryname->groupValue() == $this->categoryname->groupOldValue() && !$this->checkLevelBreak(2))
				$this->categoryname->GroupViewValue = "&nbsp;";

			// subcategoryname
			$this->subcategoryname->GroupViewValue = $this->subcategoryname->groupValue();
			$this->subcategoryname->CellAttrs["class"] = "ew-rpt-grp-field-3";
			$this->subcategoryname->GroupViewValue = DisplayGroupValue($this->subcategoryname, $this->subcategoryname->GroupViewValue);
			if ($this->subcategoryname->groupValue() == $this->subcategoryname->groupOldValue() && !$this->checkLevelBreak(3))
				$this->subcategoryname->GroupViewValue = "&nbsp;";

			// idproduct
			$this->idproduct->ViewValue = $this->idproduct->CurrentValue;
			$this->idproduct->CellAttrs["class"] = ($this->RecordCount % 2 <> 1 ? "ew-table-alt-row" : "ew-table-row");

			// pname
			$this->pname->ViewValue = $this->pname->CurrentValue;
			$this->pname->CellAttrs["class"] = ($this->RecordCount % 2 <> 1 ? "ew-table-alt-row" : "ew-table-row");

			// brand
			$this->brand->ViewValue = $this->brand->CurrentValue;
			$this->brand->CellAttrs["class"] = ($this->RecordCount % 2 <> 1 ? "ew-table-alt-row" : "ew-table-row");

			// MRP
			$this->MRP->ViewValue = $this->MRP->CurrentValue;
			$this->MRP->ViewValue = FormatNumber($this->MRP->ViewValue, 2, -2, -2, -2);
			$this->MRP->CellAttrs["class"] = ($this->RecordCount % 2 <> 1 ? "ew-table-alt-row" : "ew-table-row");

			// price
			$this->price->ViewValue = $this->price->CurrentValue;
			$this->price->ViewValue = FormatNumber($this->price->ViewValue, 2, -2, -2, -2);
			$this->price->CellAttrs["class"] = ($this->RecordCount % 2 <> 1 ? "ew-table-alt-row" : "ew-table-row");

			// description
			$this->description->ViewValue = $this->description->CurrentValue;
			$this->description->CellAttrs["class"] = ($this->RecordCount % 2 <> 1 ? "ew-table-alt-row" : "ew-table-row");

			// bussiness_name
			$this->bussiness_name->HrefValue = "";

			// categoryname
			$this->categoryname->HrefValue = "";

			// subcategoryname
			$this->subcategoryname->HrefValue = "";

			// idproduct
			$this->idproduct->HrefValue = "";

			// pname
			$this->pname->HrefValue = "";

			// brand
			$this->brand->HrefValue = "";

			// MRP
			$this->MRP->HrefValue = "";

			// price
			$this->price->HrefValue = "";

			// description
			$this->description->HrefValue = "";
		}

		// Call Cell_Rendered event
		if ($this->RowType == ROWTYPE_TOTAL) { // Summary row

			// bussiness_name
			$currentValue = $this->bussiness_name->GroupViewValue;
			$viewValue = &$this->bussiness_name->GroupViewValue;
			$viewAttrs = &$this->bussiness_name->ViewAttrs;
			$cellAttrs = &$this->bussiness_name->CellAttrs;
			$hrefValue = &$this->bussiness_name->HrefValue;
			$linkAttrs = &$this->bussiness_name->LinkAttrs;
			$this->Cell_Rendered($this->bussiness_name, $currentValue, $viewValue, $viewAttrs, $cellAttrs, $hrefValue, $linkAttrs);

			// categoryname
			$currentValue = $this->categoryname->GroupViewValue;
			$viewValue = &$this->categoryname->GroupViewValue;
			$viewAttrs = &$this->categoryname->ViewAttrs;
			$cellAttrs = &$this->categoryname->CellAttrs;
			$hrefValue = &$this->categoryname->HrefValue;
			$linkAttrs = &$this->categoryname->LinkAttrs;
			$this->Cell_Rendered($this->categoryname, $currentValue, $viewValue, $viewAttrs, $cellAttrs, $hrefValue, $linkAttrs);

			// subcategoryname
			$currentValue = $this->subcategoryname->GroupViewValue;
			$viewValue = &$this->subcategoryname->GroupViewValue;
			$viewAttrs = &$this->subcategoryname->ViewAttrs;
			$cellAttrs = &$this->subcategoryname->CellAttrs;
			$hrefValue = &$this->subcategoryname->HrefValue;
			$linkAttrs = &$this->subcategoryname->LinkAttrs;
			$this->Cell_Rendered($this->subcategoryname, $currentValue, $viewValue, $viewAttrs, $cellAttrs, $hrefValue, $linkAttrs);
		} else {

			// bussiness_name
			$currentValue = $this->bussiness_name->groupValue();
			$viewValue = &$this->bussiness_name->GroupViewValue;
			$viewAttrs = &$this->bussiness_name->ViewAttrs;
			$cellAttrs = &$this->bussiness_name->CellAttrs;
			$hrefValue = &$this->bussiness_name->HrefValue;
			$linkAttrs = &$this->bussiness_name->LinkAttrs;
			$this->Cell_Rendered($this->bussiness_name, $currentValue, $viewValue, $viewAttrs, $cellAttrs, $hrefValue, $linkAttrs);

			// categoryname
			$currentValue = $this->categoryname->groupValue();
			$viewValue = &$this->categoryname->GroupViewValue;
			$viewAttrs = &$this->categoryname->ViewAttrs;
			$cellAttrs = &$this->categoryname->CellAttrs;
			$hrefValue = &$this->categoryname->HrefValue;
			$linkAttrs = &$this->categoryname->LinkAttrs;
			$this->Cell_Rendered($this->categoryname, $currentValue, $viewValue, $viewAttrs, $cellAttrs, $hrefValue, $linkAttrs);

			// subcategoryname
			$currentValue = $this->subcategoryname->groupValue();
			$viewValue = &$this->subcategoryname->GroupViewValue;
			$viewAttrs = &$this->subcategoryname->ViewAttrs;
			$cellAttrs = &$this->subcategoryname->CellAttrs;
			$hrefValue = &$this->subcategoryname->HrefValue;
			$linkAttrs = &$this->subcategoryname->LinkAttrs;
			$this->Cell_Rendered($this->subcategoryname, $currentValue, $viewValue, $viewAttrs, $cellAttrs, $hrefValue, $linkAttrs);

			// idproduct
			$currentValue = $this->idproduct->CurrentValue;
			$viewValue = &$this->idproduct->ViewValue;
			$viewAttrs = &$this->idproduct->ViewAttrs;
			$cellAttrs = &$this->idproduct->CellAttrs;
			$hrefValue = &$this->idproduct->HrefValue;
			$linkAttrs = &$this->idproduct->LinkAttrs;
			$this->Cell_Rendered($this->idproduct, $currentValue, $viewValue, $viewAttrs, $cellAttrs, $hrefValue, $linkAttrs);

			// pname
			$currentValue = $this->pname->CurrentValue;
			$viewValue = &$this->pname->ViewValue;
			$viewAttrs = &$this->pname->ViewAttrs;
			$cellAttrs = &$this->pname->CellAttrs;
			$hrefValue = &$this->pname->HrefValue;
			$linkAttrs = &$this->pname->LinkAttrs;
			$this->Cell_Rendered($this->pname, $currentValue, $viewValue, $viewAttrs, $cellAttrs, $hrefValue, $linkAttrs);

			// brand
			$currentValue = $this->brand->CurrentValue;
			$viewValue = &$this->brand->ViewValue;
			$viewAttrs = &$this->brand->ViewAttrs;
			$cellAttrs = &$this->brand->CellAttrs;
			$hrefValue = &$this->brand->HrefValue;
			$linkAttrs = &$this->brand->LinkAttrs;
			$this->Cell_Rendered($this->brand, $currentValue, $viewValue, $viewAttrs, $cellAttrs, $hrefValue, $linkAttrs);

			// MRP
			$currentValue = $this->MRP->CurrentValue;
			$viewValue = &$this->MRP->ViewValue;
			$viewAttrs = &$this->MRP->ViewAttrs;
			$cellAttrs = &$this->MRP->CellAttrs;
			$hrefValue = &$this->MRP->HrefValue;
			$linkAttrs = &$this->MRP->LinkAttrs;
			$this->Cell_Rendered($this->MRP, $currentValue, $viewValue, $viewAttrs, $cellAttrs, $hrefValue, $linkAttrs);

			// price
			$currentValue = $this->price->CurrentValue;
			$viewValue = &$this->price->ViewValue;
			$viewAttrs = &$this->price->ViewAttrs;
			$cellAttrs = &$this->price->CellAttrs;
			$hrefValue = &$this->price->HrefValue;
			$linkAttrs = &$this->price->LinkAttrs;
			$this->Cell_Rendered($this->price, $currentValue, $viewValue, $viewAttrs, $cellAttrs, $hrefValue, $linkAttrs);

			// description
			$currentValue = $this->description->CurrentValue;
			$viewValue = &$this->description->ViewValue;
			$viewAttrs = &$this->description->ViewAttrs;
			$cellAttrs = &$this->description->CellAttrs;
			$hrefValue = &$this->description->HrefValue;
			$linkAttrs = &$this->description->LinkAttrs;
			$this->Cell_Rendered($this->description, $currentValue, $viewValue, $viewAttrs, $cellAttrs, $hrefValue, $linkAttrs);
		}

		// Call Row_Rendered event
		$this->Row_Rendered();
		$this->setupFieldCount();
	}

	// Accummulate grand summary
	protected function accumulateGrandSummary()
	{
		$this->TotalCount++;
		$cntgs = count($this->GrandSummaries);
		for ($iy = 1; $iy < $cntgs; $iy++) {
			if ($this->Columns[$iy][0]) {
				$valwrk = $this->Values[$iy];
				if ($valwrk === NULL || !is_numeric($valwrk)) {
					if (!$this->Columns[$iy][1])
						$this->GrandCounts[$iy]++;
				} else {
					if (!$this->Columns[$iy][1] || $valwrk <> 0) {
						$this->GrandCounts[$iy]++;
						$this->GrandSummaries[$iy] += $valwrk;
						if ($this->GrandMinimums[$iy] === NULL) {
							$this->GrandMinimums[$iy] = $valwrk;
							$this->GrandMaximums[$iy] = $valwrk;
						} else {
							if ($this->GrandMinimums[$iy] > $valwrk)
								$this->GrandMinimums[$iy] = $valwrk;
							if ($this->GrandMaximums[$iy] < $valwrk)
								$this->GrandMaximums[$iy] = $valwrk;
						}
					}
				}
			}
		}
	}

	// Load group db values if necessary
	protected function loadGroupDbValues()
	{
		$conn = &$this->getConnection();
	}

	// Set up popup
	protected function setupPopup()
	{
		global $ReportLanguage;
		$conn = &$this->getConnection();
		if ($this->DrillDown)
			return;

		// Process post back form
		if (IsPost()) {
			$name = Post("popup", ""); // Get popup form name
			if ($name <> "") {
				$arValues = Post("sel_$name");
				$cntValues = is_array($arValues) ? count($arValues) : 0;
				if ($cntValues > 0) {
					if (trim($arValues[0]) == "") // Select all
						$arValues = INIT_VALUE;
					$this->PopupName = $name;
					if (IsAdvancedFilterValue($arValues) || $arValues == INIT_VALUE)
						$this->PopupValue = $arValues;
					if (!MatchedArray($arValues, @$_SESSION["sel_$name"])) {
						if ($this->hasSessionFilterValues($name))
							$this->ExpiredExtendedFilter = $name; // Clear extended filter for this field
					}
					$_SESSION["sel_$name"] = $arValues;
					$_SESSION["rf_$name"] = Post("rf_$name", "");
					$_SESSION["rt_$name"] = Post("rt_$name", "");
					$this->resetPager();
				}
			}

		// Get 'reset' command
		} elseif (Get("cmd") !== NULL) {
			$cmd = Get("cmd");
			if (SameText($cmd, "reset")) {
				$this->resetPager();
			}
		}

		// Load selection criteria to array
	}

	// Setup field count
	protected function setupFieldCount()
	{
		$this->GroupColumnCount = 0;
		$this->SubGroupColumnCount = 0;
		$this->DetailColumnCount = 0;
		if ($this->bussiness_name->Visible)
			$this->GroupColumnCount += 1;
		if ($this->categoryname->Visible) {
			$this->GroupColumnCount += 1;
			$this->SubGroupColumnCount += 1;
		}
		if ($this->subcategoryname->Visible) {
			$this->GroupColumnCount += 1;
			$this->SubGroupColumnCount += 1;
		}
		if ($this->idproduct->Visible)
			$this->DetailColumnCount += 1;
		if ($this->pname->Visible)
			$this->DetailColumnCount += 1;
		if ($this->brand->Visible)
			$this->DetailColumnCount += 1;
		if ($this->MRP->Visible)
			$this->DetailColumnCount += 1;
		if ($this->price->Visible)
			$this->DetailColumnCount += 1;
		if ($this->description->Visible)
			$this->DetailColumnCount += 1;
	}

	// Set up Breadcrumb
	protected function setupBreadcrumb()
	{
		global $Breadcrumb;
		$Breadcrumb = new Breadcrumb();
		$url = substr(CurrentUrl(), strrpos(CurrentUrl(), "/") + 1);
		$url = preg_replace('/\?cmd=reset(all){0,1}$/i', "", $url); // Remove cmd=reset / cmd=resetall
		$Breadcrumb->add("summary", $this->TableVar, $url, "", $this->TableVar, TRUE);
	}

	// Set up export options (extended)
	protected function setupExportOptionsExt()
	{
		global $ReportLanguage, $ReportOptions;
		$reportTypes = $ReportOptions["ReportTypes"];
		$ReportOptions["ReportTypes"] = $reportTypes;
	}

	// Export to HTML
	public function exportHtml($html)
	{

		//global $ExportFileName;
		//header('Content-Type: text/html' . (PROJECT_CHARSET <> '' ? ';charset=' . PROJECT_CHARSET : ''));
		//header('Content-Disposition: attachment; filename=' . $ExportFileName . '.html');

		$folder = ReportParam("folder", "");
		$fileName = ReportParam("filename", "");
		$responseType = ReportParam("responsetype", "");
		$saveToFile = "";

		// Save generate file for print
		if ($folder <> "" && $fileName <> "" && ($responseType == "json" || $responseType == "file" && REPORT_SAVE_OUTPUT_ON_SERVER)) {
			$baseTag = "<base href=\"" . BaseUrl() . "\">";
			$html = preg_replace('/<head>/', '<head>' . $baseTag, $html);
			SaveFile($folder, $fileName, $html);
			$saveToFile = UploadPath(FALSE, $folder) . $fileName;
		}
		if ($saveToFile == "" || $responseType == "file")
			Write($html);
		return $saveToFile;
	}

	// Set up starting group
	protected function setupStartGroup()
	{

		// Exit if no groups
		if ($this->DisplayGroups == 0)
			return;
		$startGrp = ReportParam(TABLE_START_GROUP, "");
		$pageNo = ReportParam("pageno", "");

		// Check for a 'start' parameter
		if ($startGrp != "") {
			$this->StartGroup = $startGrp;
			$this->setStartGroup($this->StartGroup);
		} elseif ($pageNo != "") {
			if (is_numeric($pageNo)) {
				$this->StartGroup = ($pageNo - 1) * $this->DisplayGroups + 1;
				if ($this->StartGroup <= 0) {
					$this->StartGroup = 1;
				} elseif ($this->StartGroup >= intval(($this->TotalGroups - 1) / $this->DisplayGroups) * $this->DisplayGroups + 1) {
					$this->StartGroup = intval(($this->TotalGroups - 1) / $this->DisplayGroups) * $this->DisplayGroups + 1;
				}
				$this->setStartGroup($this->StartGroup);
			} else {
				$this->StartGroup = $this->getStartGroup();
			}
		} else {
			$this->StartGroup = $this->getStartGroup();
		}

		// Check if correct start group counter
		if (!is_numeric($this->StartGroup) || $this->StartGroup == "") { // Avoid invalid start group counter
			$this->StartGroup = 1; // Reset start group counter
			$this->setStartGroup($this->StartGroup);
		} elseif (intval($this->StartGroup) > intval($this->TotalGroups)) { // Avoid starting group > total groups
			$this->StartGroup = intval(($this->TotalGroups - 1) / $this->DisplayGroups) * $this->DisplayGroups + 1; // Point to last page first group
			$this->setStartGroup($this->StartGroup);
		} elseif (($this->StartGroup-1) % $this->DisplayGroups <> 0) {
			$this->StartGroup = intval(($this->StartGroup - 1) / $this->DisplayGroups) * $this->DisplayGroups + 1; // Point to page boundary
			$this->setStartGroup($this->StartGroup);
		}
	}

	// Reset pager
	protected function resetPager()
	{

		// Reset start position (reset command)
		$this->StartGroup = 1;
		$this->setStartGroup($this->StartGroup);
	}

	// Set up number of groups displayed per page
	protected function setupDisplayGroups()
	{
		if (ReportParam(TABLE_GROUP_PER_PAGE) !== NULL) {
			$wrk = ReportParam(TABLE_GROUP_PER_PAGE);
			if (is_numeric($wrk)) {
				$this->DisplayGroups = intval($wrk);
			} else {
				if (strtoupper($wrk) == "ALL") { // Display all groups
					$this->DisplayGroups = -1;
				} else {
					$this->DisplayGroups = 3; // Non-numeric, load default
				}
			}
			$this->setGroupPerPage($this->DisplayGroups); // Save to session

			// Reset start position (reset command)
			$this->StartGroup = 1;
			$this->setStartGroup($this->StartGroup);
		} else {
			if ($this->getGroupPerPage() <> "") {
				$this->DisplayGroups = $this->getGroupPerPage(); // Restore from session
			} else {
				$this->DisplayGroups = 3; // Load default
			}
		}
	}

	// Get sort parameters based on sort links clicked
	protected function getSort()
	{
		if ($this->DrillDown)
			return "";
		$resetSort = ReportParam("cmd") === "resetsort";
		$orderBy = ReportParam("order", "");
		$orderType = ReportParam("ordertype", "");

		// Check for a resetsort command
		if ($resetSort) {
			$this->setOrderBy("");
			$this->setStartGroup(1);
			$this->bussiness_name->setSort("");
			$this->categoryname->setSort("");
			$this->subcategoryname->setSort("");
			$this->idproduct->setSort("");
			$this->pname->setSort("");
			$this->brand->setSort("");
			$this->MRP->setSort("");
			$this->price->setSort("");
			$this->description->setSort("");

		// Check for an Order parameter
		} elseif ($orderBy <> "") {
			$this->CurrentOrder = $orderBy;
			$this->CurrentOrderType = $orderType;
			$sortSql = $this->sortSql();
			$this->setOrderBy($sortSql);
			$this->setStartGroup(1);
		}
		return $this->getOrderBy();
	}

	// Return extended filter
	protected function getExtendedFilter()
	{
		global $FormError;
		$filter = "";
		if ($this->DrillDown)
			return "";
		$postBack = IsPost();
		$restoreSession = TRUE;
		$setupFilter = FALSE;

		// Reset extended filter if filter changed
		if ($postBack) {

		// Reset search command
		} elseif (Get("cmd", "") == "reset") {

			// Load default values
			$this->setSessionDropDownValue($this->pname->DropDownValue, $this->pname->AdvancedSearch->SearchOperator, "pname"); // Field pname
			$this->setSessionDropDownValue($this->brand->DropDownValue, $this->brand->AdvancedSearch->SearchOperator, "brand"); // Field brand
			$this->setSessionDropDownValue($this->bussiness_name->DropDownValue, $this->bussiness_name->AdvancedSearch->SearchOperator, "bussiness_name"); // Field bussiness_name
			$this->setSessionDropDownValue($this->categoryname->DropDownValue, $this->categoryname->AdvancedSearch->SearchOperator, "categoryname"); // Field categoryname
			$this->setSessionDropDownValue($this->subcategoryname->DropDownValue, $this->subcategoryname->AdvancedSearch->SearchOperator, "subcategoryname"); // Field subcategoryname

			//$setupFilter = TRUE; // No need to set up, just use default
		} else {
			$restoreSession = !$this->SearchCommand;

			// Field pname
			if ($this->getDropDownValue($this->pname)) {
				$setupFilter = TRUE;
			} elseif ($this->pname->DropDownValue <> INIT_VALUE && !isset($_SESSION["x_Product_Report__pname"])) {
				$setupFilter = TRUE;
			}

			// Field brand
			if ($this->getDropDownValue($this->brand)) {
				$setupFilter = TRUE;
			} elseif ($this->brand->DropDownValue <> INIT_VALUE && !isset($_SESSION["x_Product_Report__brand"])) {
				$setupFilter = TRUE;
			}

			// Field bussiness_name
			if ($this->getDropDownValue($this->bussiness_name)) {
				$setupFilter = TRUE;
			} elseif ($this->bussiness_name->DropDownValue <> INIT_VALUE && !isset($_SESSION["x_Product_Report__bussiness_name"])) {
				$setupFilter = TRUE;
			}

			// Field categoryname
			if ($this->getDropDownValue($this->categoryname)) {
				$setupFilter = TRUE;
			} elseif ($this->categoryname->DropDownValue <> INIT_VALUE && !isset($_SESSION["x_Product_Report__categoryname"])) {
				$setupFilter = TRUE;
			}

			// Field subcategoryname
			if ($this->getDropDownValue($this->subcategoryname)) {
				$setupFilter = TRUE;
			} elseif ($this->subcategoryname->DropDownValue <> INIT_VALUE && !isset($_SESSION["x_Product_Report__subcategoryname"])) {
				$setupFilter = TRUE;
			}
			if (!$this->validateForm()) {
				$this->setFailureMessage($FormError);
				return $filter;
			}
		}

		// Restore session
		if ($restoreSession) {
			$this->getSessionDropDownValue($this->pname); // Field pname
			$this->getSessionDropDownValue($this->brand); // Field brand
			$this->getSessionDropDownValue($this->bussiness_name); // Field bussiness_name
			$this->getSessionDropDownValue($this->categoryname); // Field categoryname
			$this->getSessionDropDownValue($this->subcategoryname); // Field subcategoryname
		}

		// Call page filter validated event
		$this->Page_FilterValidated();

		// Build SQL
		$this->buildDropDownFilter($this->pname, $filter, $this->pname->AdvancedSearch->SearchOperator, FALSE, TRUE); // Field pname
		$this->buildDropDownFilter($this->brand, $filter, $this->brand->AdvancedSearch->SearchOperator, FALSE, TRUE); // Field brand
		$this->buildDropDownFilter($this->bussiness_name, $filter, $this->bussiness_name->AdvancedSearch->SearchOperator, FALSE, TRUE); // Field bussiness_name
		$this->buildDropDownFilter($this->categoryname, $filter, $this->categoryname->AdvancedSearch->SearchOperator, FALSE, TRUE); // Field categoryname
		$this->buildDropDownFilter($this->subcategoryname, $filter, $this->subcategoryname->AdvancedSearch->SearchOperator, FALSE, TRUE); // Field subcategoryname

		// Save parms to session
		$this->setSessionDropDownValue($this->pname->DropDownValue, $this->pname->AdvancedSearch->SearchOperator, "pname"); // Field pname
		$this->setSessionDropDownValue($this->brand->DropDownValue, $this->brand->AdvancedSearch->SearchOperator, "brand"); // Field brand
		$this->setSessionDropDownValue($this->bussiness_name->DropDownValue, $this->bussiness_name->AdvancedSearch->SearchOperator, "bussiness_name"); // Field bussiness_name
		$this->setSessionDropDownValue($this->categoryname->DropDownValue, $this->categoryname->AdvancedSearch->SearchOperator, "categoryname"); // Field categoryname
		$this->setSessionDropDownValue($this->subcategoryname->DropDownValue, $this->subcategoryname->AdvancedSearch->SearchOperator, "subcategoryname"); // Field subcategoryname

		// Setup filter
		if ($setupFilter) {
		}

		// Field pname
		LoadDropDownList($this->pname->DropDownList, $this->pname->DropDownValue);

		// Field brand
		LoadDropDownList($this->brand->DropDownList, $this->brand->DropDownValue);

		// Field bussiness_name
		LoadDropDownList($this->bussiness_name->DropDownList, $this->bussiness_name->DropDownValue);

		// Field categoryname
		LoadDropDownList($this->categoryname->DropDownList, $this->categoryname->DropDownValue);

		// Field subcategoryname
		LoadDropDownList($this->subcategoryname->DropDownList, $this->subcategoryname->DropDownValue);
		return $filter;
	}

	// Build dropdown filter
	protected function buildDropDownFilter(&$fld, &$filterClause, $fldOpr, $default = FALSE, $saveFilter = FALSE)
	{
		$fldVal = ($default) ? $fld->DefaultDropDownValue : $fld->DropDownValue;
		$sql = "";
		if (is_array($fldVal)) {
			foreach ($fldVal as $val) {
				$wrk = $this->getDropDownFilter($fld, $val, $fldOpr);

				// Call Page Filtering event
				if (!StartsString("@@", $val))
					$this->Page_Filtering($fld, $wrk, "dropdown", $fldOpr, $val);
				if ($wrk <> "") {
					if ($sql <> "")
						$sql .= " OR " . $wrk;
					else
						$sql = $wrk;
				}
			}
		} else {
			$sql = $this->getDropDownFilter($fld, $fldVal, $fldOpr);

			// Call Page Filtering event
			if (!StartsString("@@", $fldVal))
				$this->Page_Filtering($fld, $sql, "dropdown", $fldOpr, $fldVal);
		}
		if ($sql <> "") {
			AddFilter($filterClause, $sql);
			if ($saveFilter) $fld->CurrentFilter = $sql;
		}
	}

	// Get dropdown filter
	protected function getDropDownFilter(&$fld, $fldVal, $fldOpr)
	{
		$fldName = $fld->Name;
		$fldExpression = $fld->Expression;
		$fldDataType = $fld->DataType;
		$fldDelimiter = $fld->Delimiter;
		$fldVal = strval($fldVal);
		if ($fldOpr == "") $fldOpr = "=";
		$wrk = "";
		if (SameString($fldVal, NULL_VALUE)) {
			$wrk = $fldExpression . " IS NULL";
		} elseif (SameString($fldVal, NOT_NULL_VALUE)) {
			$wrk = $fldExpression . " IS NOT NULL";
		} elseif (SameString($fldVal, EMPTY_VALUE)) {
			$wrk = $fldExpression . " = ''";
		} elseif (SameString($fldVal, ALL_VALUE)) {
			$wrk = "1 = 1";
		} else {
			if (StartsString("@@", $fldVal)) {
				$wrk = $this->getCustomFilter($fld, $fldVal, $this->Dbid);
			} elseif ($fldDelimiter <> "" && trim($fldVal) <> "" && ($fldDataType == DATATYPE_STRING || $fldDataType == DATATYPE_MEMO)) {
				$wrk = GetMultiValueSearchSql($fldExpression, trim($fldVal), $this->Dbid);
			} else {
				if ($fldVal <> "" && $fldVal <> INIT_VALUE) {
					if ($fldDataType == DATATYPE_DATE && $fldOpr <> "") {
						$wrk = GetDateFilterSql($fldExpression, $fldOpr, $fldVal, $fldDataType, $this->Dbid);
					} else {
						$wrk = GetFilterSql($fldOpr, $fldVal, $fldDataType, $this->Dbid);
						if ($wrk <> "") $wrk = $fldExpression . $wrk;
					}
				}
			}
		}
		return $wrk;
	}

	// Get custom filter
	protected function getCustomFilter(&$fld, $fldVal, $dbid = 0)
	{
		$wrk = "";
		if (is_array($fld->AdvancedFilters)) {
			foreach ($fld->AdvancedFilters as $filter) {
				if ($filter->ID == $fldVal && $filter->Enabled) {
					$fldExpr = $fld->Expression;
					$fn = $filter->FunctionName;
					$wrkid = StartsString("@@", $filter->ID) ? substr($filter->ID, 2) : $filter->ID;
					if ($fn <> "") {
						$fn = PROJECT_NAMESPACE . $fn;
						$wrk = $fn($fldExpr, $dbid);
					} else
						$wrk = "";
					$this->Page_Filtering($fld, $wrk, "custom", $wrkid);
					break;
				}
			}
		}
		return $wrk;
	}

	// Build extended filter
	protected function buildExtendedFilter(&$fld, &$filterClause, $default = FALSE, $saveFilter = FALSE)
	{
		$wrk = GetExtendedFilter($fld, $default, $this->Dbid);
		if (!$default)
			$this->Page_Filtering($fld, $wrk, "extended", $fld->AdvancedSearch->SearchOperator, $fld->AdvancedSearch->SearchValue, $fld->AdvancedSearch->SearchCondition, $fld->AdvancedSearch->SearchOperator2, $fld->AdvancedSearch->SearchValue2);
		if ($wrk <> "") {
			AddFilter($filterClause, $wrk);
			if ($saveFilter) $fld->CurrentFilter = $wrk;
		}
	}

	// Get drop down value from querystring
	protected function getDropDownValue(&$fld)
	{
		$parm = substr($fld->FieldVar, 2);
		if (IsPost())
			return FALSE; // Skip post back
		$opr = Get("z_$parm");
		if ($opr !== NULL)
			$fld->AdvancedSearch->SearchOperator = $opr;
		$val = Get("x_$parm");
		if ($val !== NULL) {
			if ($fld->isMultiSelect() && !is_array($val)) // Split values for modal lookup
				$fld->DropDownValue = explode(LOOKUP_FILTER_VALUE_SEPARATOR, $val);
			else
				$fld->DropDownValue = $val;
			return TRUE;
		}
		return FALSE;
	}

	// Get filter values from querystring
	protected function getFilterValues(&$fld)
	{
		$parm = substr($fld->FieldVar, 2);
		if (IsPost())
			return; // Skip post back
		$got = FALSE;
		if (Get("x_$parm") !== NULL) {
			$fld->AdvancedSearch->SearchValue = Get("x_$parm");
			$got = TRUE;
		}
		if (Get("z_$parm") !== NULL) {
			$fld->AdvancedSearch->SearchOperator = Get("z_$parm");
			$got = TRUE;
		}
		if (Get("v_$parm") !== NULL) {
			$fld->AdvancedSearch->SearchCondition = Get("v_$parm");
			$got = TRUE;
		}
		if (Get("y_$parm") !== NULL) {
			$fld->AdvancedSearch->SearchValue2 = Get("y_$parm");
			$got = TRUE;
		}
		if (Get("w_$parm") !== NULL) {
			$fld->AdvancedSearch->SearchOperator2 = Get("w_$parm");
			$got = TRUE;
		}
		return $got;
	}

	// Set default ext filter
	protected function setDefaultExtFilter(&$fld, $so1, $sv1, $sc, $so2, $sv2)
	{
		$fld->AdvancedSearch->SearchValueDefault = $sv1; // Default ext filter value 1
		$fld->AdvancedSearch->SearchValue2Default = $sv2; // Default ext filter value 2 (if operator 2 is enabled)
		$fld->AdvancedSearch->SearchOperatorDefault = $so1; // Default search operator 1
		$fld->AdvancedSearch->SearchOperator2Default = $so2; // Default search operator 2 (if operator 2 is enabled)
		$fld->AdvancedSearch->SearchConditionDefault = $sc; // Default search condition (if operator 2 is enabled)
	}

	// Apply default ext filter
	protected function applyDefaultExtFilter(&$fld)
	{
		$fld->AdvancedSearch->SearchValue = $fld->AdvancedSearch->SearchValueDefault;
		$fld->AdvancedSearch->SearchValue2 = $fld->AdvancedSearch->SearchValue2Default;
		$fld->AdvancedSearch->SearchOperator = $fld->AdvancedSearch->SearchOperatorDefault;
		$fld->AdvancedSearch->SearchOperator2 = $fld->AdvancedSearch->SearchOperator2Default;
		$fld->AdvancedSearch->SearchCondition = $fld->AdvancedSearch->SearchConditionDefault;
	}

	// Check if Text Filter applied
	protected function textFilterApplied(&$fld)
	{
		return (strval($fld->AdvancedSearch->SearchValue) <> strval($fld->AdvancedSearch->SearchValueDefault) ||
			strval($fld->AdvancedSearch->SearchValue2) <> strval($fld->AdvancedSearch->SearchValue2Default) ||
			(strval($fld->AdvancedSearch->SearchValue) <> "" &&
				strval($fld->AdvancedSearch->SearchOperator) <> strval($fld->AdvancedSearch->SearchOperatorDefault)) ||
			(strval($fld->AdvancedSearch->SearchValue2) <> "" &&
				strval($fld->AdvancedSearch->SearchOperator2) <> strval($fld->AdvancedSearch->SearchOperator2Default)) ||
			strval($fld->AdvancedSearch->SearchCondition) <> strval($fld->AdvancedSearch->SearchConditionDefault));
	}

	// Check if Non-Text Filter applied
	protected function nonTextFilterApplied(&$fld)
	{
		if (is_array($fld->DropDownValue)) {
			if (is_array($fld->DefaultDropDownValue)) {
				if (count($fld->DefaultDropDownValue) <> count($fld->DropDownValue))
					return TRUE;
				else
					return (count(array_diff($fld->DefaultDropDownValue, $fld->DropDownValue)) <> 0);
			} else {
				return TRUE;
			}
		} else {
			if (is_array($fld->DefaultDropDownValue))
				return TRUE;
			else
				$v1 = strval($fld->DefaultDropDownValue);
			if ($v1 == INIT_VALUE)
				$v1 = "";
			$v2 = strval($fld->DropDownValue);
			if ($v2 == INIT_VALUE || $v2 == ALL_VALUE)
				$v2 = "";
			return ($v1 <> $v2);
		}
	}

	// Get dropdown value from session
	protected function getSessionDropDownValue(&$fld)
	{
		$parm = substr($fld->FieldVar, 2);
		$this->getSessionValue($fld->DropDownValue, 'x_Product_Report__' . $parm);
		$this->getSessionValue($fld->AdvancedSearch->SearchOperator, 'z_Product_Report__' . $parm);
	}

	// Get filter values from session
	protected function getSessionFilterValues(&$fld)
	{
		$parm = substr($fld->FieldVar, 2);
		$this->getSessionValue($fld->AdvancedSearch->SearchValue, 'x_Product_Report__' . $parm);
		$this->getSessionValue($fld->AdvancedSearch->SearchOperator, 'z_Product_Report__' . $parm);
		$this->getSessionValue($fld->AdvancedSearch->SearchCondition, 'v_Product_Report__' . $parm);
		$this->getSessionValue($fld->AdvancedSearch->SearchValue2, 'y_Product_Report__' . $parm);
		$this->getSessionValue($fld->AdvancedSearch->SearchOperator2, 'w_Product_Report__' . $parm);
	}

	// Get value from session
	protected function getSessionValue(&$sv, $sn)
	{
		if (array_key_exists($sn, $_SESSION))
			$sv = $_SESSION[$sn];
	}

	// Set dropdown value to session
	protected function setSessionDropDownValue($sv, $so, $parm)
	{
		$_SESSION['x_Product_Report__' . $parm] = $sv;
		$_SESSION['z_Product_Report__' . $parm] = $so;
	}

	// Set filter values to session
	protected function setSessionFilterValues($sv1, $so1, $sc, $sv2, $so2, $parm)
	{
		$_SESSION['x_Product_Report__' . $parm] = $sv1;
		$_SESSION['z_Product_Report__' . $parm] = $so1;
		$_SESSION['v_Product_Report__' . $parm] = $sc;
		$_SESSION['y_Product_Report__' . $parm] = $sv2;
		$_SESSION['w_Product_Report__' . $parm] = $so2;
	}

	// Check if has session filter values
	protected function hasSessionFilterValues($parm)
	{
		return (@$_SESSION['x_' . $parm] <> "" && @$_SESSION['x_' . $parm] <> INIT_VALUE ||
			@$_SESSION['x_' . $parm] <> "" && @$_SESSION['x_' . $parm] <> INIT_VALUE ||
			@$_SESSION['y_' . $parm] <> "" && @$_SESSION['y_' . $parm] <> INIT_VALUE);
	}

	// Dropdown filter exist
	protected function dropDownFilterExist(&$fld, $fldOpr)
	{
		$wrk = "";
		$this->buildDropDownFilter($fld, $wrk, $fldOpr);
		return ($wrk <> "");
	}

	// Extended filter exist
	protected function extendedFilterExist(&$fld)
	{
		$extWrk = "";
		$this->buildExtendedFilter($fld, $extWrk);
		return ($extWrk <> "");
	}

	// Validate form
	protected function validateForm()
	{
		global $ReportLanguage, $FormError;

		// Initialize form error message
		$FormError = "";

		// Check if validation required
		if (!SERVER_VALIDATE)
			return ($FormError == "");

		// Return validate result
		$validateForm = ($FormError == "");

		// Call Form_CustomValidate event
		$formCustomError = "";
		$validateForm = $validateForm && $this->Form_CustomValidate($formCustomError);
		if ($formCustomError <> "") {
			$FormError .= ($FormError <> "") ? "<p>&nbsp;</p>" : "";
			$FormError .= $formCustomError;
		}
		return $validateForm;
	}

	// Clear selection stored in session
	protected function clearSessionSelection($parm)
	{
		$_SESSION["sel_Product_Report__$parm"] = "";
		$_SESSION["rf_Product_Report__$parm"] = "";
		$_SESSION["rt_Product_Report__$parm"] = "";
	}

	// Load selection from session
	protected function loadSelectionFromSession($parm)
	{
		foreach ($this->fields as $fld) {
			if ($fld->Param == $parm) {
				$fld->SelectionList = @$_SESSION["sel_Product_Report__$parm"];
				$fld->RangeFrom = @$_SESSION["rf_Product_Report__$parm"];
				$fld->RangeTo = @$_SESSION["rt_Product_Report__$parm"];
				break;
			}
		}
	}

	// Load default value for filters
	protected function loadDefaultFilters()
	{

		/**
		* Set up default values for non Text filters
		*/
		// Field pname

		$this->pname->DefaultDropDownValue = INIT_VALUE;
		if (!$this->SearchCommand)
			$this->pname->DropDownValue = $this->pname->DefaultDropDownValue;

		// Field brand
		$this->brand->DefaultDropDownValue = INIT_VALUE;
		if (!$this->SearchCommand)
			$this->brand->DropDownValue = $this->brand->DefaultDropDownValue;

		// Field bussiness_name
		$this->bussiness_name->DefaultDropDownValue = INIT_VALUE;
		if (!$this->SearchCommand)
			$this->bussiness_name->DropDownValue = $this->bussiness_name->DefaultDropDownValue;

		// Field categoryname
		$this->categoryname->DefaultDropDownValue = INIT_VALUE;
		if (!$this->SearchCommand)
			$this->categoryname->DropDownValue = $this->categoryname->DefaultDropDownValue;

		// Field subcategoryname
		$this->subcategoryname->DefaultDropDownValue = INIT_VALUE;
		if (!$this->SearchCommand)
			$this->subcategoryname->DropDownValue = $this->subcategoryname->DefaultDropDownValue;

		/**
		* Set up default values for extended filters
		* function setDefaultExtFilter(&$fld, $so1, $sv1, $sc, $so2, $sv2)
		* Parameters:
		* $fld - Field object
		* $so1 - Default search operator 1
		* $sv1 - Default ext filter value 1
		* $sc - Default search condition (if operator 2 is enabled)
		* $so2 - Default search operator 2 (if operator 2 is enabled)
		* $sv2 - Default ext filter value 2 (if operator 2 is enabled)
		*/

		/**
		* Set up default values for popup filters
		*/
	}

	// Check if filter applied
	protected function checkFilter()
	{

		// Check pname extended filter
		if ($this->nonTextFilterApplied($this->pname))
			return TRUE;

		// Check brand extended filter
		if ($this->nonTextFilterApplied($this->brand))
			return TRUE;

		// Check bussiness_name extended filter
		if ($this->nonTextFilterApplied($this->bussiness_name))
			return TRUE;

		// Check categoryname extended filter
		if ($this->nonTextFilterApplied($this->categoryname))
			return TRUE;

		// Check subcategoryname extended filter
		if ($this->nonTextFilterApplied($this->subcategoryname))
			return TRUE;
		return FALSE;
	}

	// Show list of filters
	public function showFilterList($showDate = FALSE)
	{
		global $ReportLanguage;

		// Initialize
		$filterList = "";
		$captionClass = $this->isExport("email") ? "ew-filter-caption-email" : "ew-filter-caption";
		$captionSuffix = $this->isExport("email") ? ": " : "";

		// Field pname
		$extWrk = "";
		$wrk = "";
		$this->buildDropDownFilter($this->pname, $extWrk, $this->pname->AdvancedSearch->SearchOperator);
		$filter = "";
		if ($extWrk <> "")
			$filter .= "<span class=\"ew-filter-value\">$extWrk</span>";
		elseif ($wrk <> "")
			$filter .= "<span class=\"ew-filter-value\">$wrk</span>";
		if ($filter <> "")
			$filterList .= "<div><span class=\"" . $captionClass . "\">" . $this->pname->caption() . "</span>" . $captionSuffix . $filter . "</div>";

		// Field brand
		$extWrk = "";
		$wrk = "";
		$this->buildDropDownFilter($this->brand, $extWrk, $this->brand->AdvancedSearch->SearchOperator);
		$filter = "";
		if ($extWrk <> "")
			$filter .= "<span class=\"ew-filter-value\">$extWrk</span>";
		elseif ($wrk <> "")
			$filter .= "<span class=\"ew-filter-value\">$wrk</span>";
		if ($filter <> "")
			$filterList .= "<div><span class=\"" . $captionClass . "\">" . $this->brand->caption() . "</span>" . $captionSuffix . $filter . "</div>";

		// Field bussiness_name
		$extWrk = "";
		$wrk = "";
		$this->buildDropDownFilter($this->bussiness_name, $extWrk, $this->bussiness_name->AdvancedSearch->SearchOperator);
		$filter = "";
		if ($extWrk <> "")
			$filter .= "<span class=\"ew-filter-value\">$extWrk</span>";
		elseif ($wrk <> "")
			$filter .= "<span class=\"ew-filter-value\">$wrk</span>";
		if ($filter <> "")
			$filterList .= "<div><span class=\"" . $captionClass . "\">" . $this->bussiness_name->caption() . "</span>" . $captionSuffix . $filter . "</div>";

		// Field categoryname
		$extWrk = "";
		$wrk = "";
		$this->buildDropDownFilter($this->categoryname, $extWrk, $this->categoryname->AdvancedSearch->SearchOperator);
		$filter = "";
		if ($extWrk <> "")
			$filter .= "<span class=\"ew-filter-value\">$extWrk</span>";
		elseif ($wrk <> "")
			$filter .= "<span class=\"ew-filter-value\">$wrk</span>";
		if ($filter <> "")
			$filterList .= "<div><span class=\"" . $captionClass . "\">" . $this->categoryname->caption() . "</span>" . $captionSuffix . $filter . "</div>";

		// Field subcategoryname
		$extWrk = "";
		$wrk = "";
		$this->buildDropDownFilter($this->subcategoryname, $extWrk, $this->subcategoryname->AdvancedSearch->SearchOperator);
		$filter = "";
		if ($extWrk <> "")
			$filter .= "<span class=\"ew-filter-value\">$extWrk</span>";
		elseif ($wrk <> "")
			$filter .= "<span class=\"ew-filter-value\">$wrk</span>";
		if ($filter <> "")
			$filterList .= "<div><span class=\"" . $captionClass . "\">" . $this->subcategoryname->caption() . "</span>" . $captionSuffix . $filter . "</div>";
		$divdataclass = "";

		// Show Filters
		if ($filterList <> "" || $showDate) {
			$message = "<div" . $divdataclass . "><div id=\"ew-filter-list\" class=\"alert alert-info d-table\">";
			if ($showDate)
				$message .= "<div id=\"ew-current-date\">" . $ReportLanguage->phrase("ReportGeneratedDate") . FormatDateTime(date("Y-m-d H:i:s"), 1) . "</div>";
			if ($filterList <> "")
				$message .= "<div id=\"ew-current-filters\">" . $ReportLanguage->phrase("CurrentFilters") . "</div>" . $filterList;
			$message .= "</div></div>";
			$this->Message_Showing($message, "");
			Write($message);
		}
	}

	// Get list of filters
	public function getFilterList()
	{

		// Initialize
		$filterList = "";

		// Field pname
		$wrk = "";
		$wrk = ($this->pname->DropDownValue <> INIT_VALUE) ? $this->pname->DropDownValue : "";
		if (is_array($wrk))
			$wrk = implode("||", $wrk);
		if ($wrk <> "")
			$wrk = "\"x_pname\":\"" . JsEncode($wrk) . "\"";
		if ($wrk <> "") {
			if ($filterList <> "") $filterList .= ",";
			$filterList .= $wrk;
		}

		// Field brand
		$wrk = "";
		$wrk = ($this->brand->DropDownValue <> INIT_VALUE) ? $this->brand->DropDownValue : "";
		if (is_array($wrk))
			$wrk = implode("||", $wrk);
		if ($wrk <> "")
			$wrk = "\"x_brand\":\"" . JsEncode($wrk) . "\"";
		if ($wrk <> "") {
			if ($filterList <> "") $filterList .= ",";
			$filterList .= $wrk;
		}

		// Field bussiness_name
		$wrk = "";
		$wrk = ($this->bussiness_name->DropDownValue <> INIT_VALUE) ? $this->bussiness_name->DropDownValue : "";
		if (is_array($wrk))
			$wrk = implode("||", $wrk);
		if ($wrk <> "")
			$wrk = "\"x_bussiness_name\":\"" . JsEncode($wrk) . "\"";
		if ($wrk <> "") {
			if ($filterList <> "") $filterList .= ",";
			$filterList .= $wrk;
		}

		// Field categoryname
		$wrk = "";
		$wrk = ($this->categoryname->DropDownValue <> INIT_VALUE) ? $this->categoryname->DropDownValue : "";
		if (is_array($wrk))
			$wrk = implode("||", $wrk);
		if ($wrk <> "")
			$wrk = "\"x_categoryname\":\"" . JsEncode($wrk) . "\"";
		if ($wrk <> "") {
			if ($filterList <> "") $filterList .= ",";
			$filterList .= $wrk;
		}

		// Field subcategoryname
		$wrk = "";
		$wrk = ($this->subcategoryname->DropDownValue <> INIT_VALUE) ? $this->subcategoryname->DropDownValue : "";
		if (is_array($wrk))
			$wrk = implode("||", $wrk);
		if ($wrk <> "")
			$wrk = "\"x_subcategoryname\":\"" . JsEncode($wrk) . "\"";
		if ($wrk <> "") {
			if ($filterList <> "") $filterList .= ",";
			$filterList .= $wrk;
		}

		// Return filter list in json
		if ($filterList <> "")
			return "{\"data\":{" . $filterList . "}}";
		else
			return "null";
	}

	// Restore list of filters
	protected function restoreFilterList()
	{

		// Return if not reset filter
		if (Post("cmd", "") <> "resetfilter")
			return FALSE;
		$filter = json_decode(Post("filter", ""), TRUE);
		return $this->setupFilterList($filter);
	}

	// Setup list of filters
	protected function setupFilterList($filter)
	{
		if (!is_array($filter))
			return FALSE;

		// Field pname
		$restoreFilter = FALSE;
		if (array_key_exists("x_pname", $filter)) {
			$wrk = $filter["x_pname"];
			if (strpos($wrk, "||") !== FALSE)
				$wrk = explode("||", $wrk);
			$this->setSessionDropDownValue($wrk, @$filter["z_pname"], "pname");
			$restoreFilter = TRUE;
		}
		if (!$restoreFilter) { // Clear filter
			$this->setSessionDropDownValue(INIT_VALUE, "", "pname");
		}

		// Field brand
		$restoreFilter = FALSE;
		if (array_key_exists("x_brand", $filter)) {
			$wrk = $filter["x_brand"];
			if (strpos($wrk, "||") !== FALSE)
				$wrk = explode("||", $wrk);
			$this->setSessionDropDownValue($wrk, @$filter["z_brand"], "brand");
			$restoreFilter = TRUE;
		}
		if (!$restoreFilter) { // Clear filter
			$this->setSessionDropDownValue(INIT_VALUE, "", "brand");
		}

		// Field bussiness_name
		$restoreFilter = FALSE;
		if (array_key_exists("x_bussiness_name", $filter)) {
			$wrk = $filter["x_bussiness_name"];
			if (strpos($wrk, "||") !== FALSE)
				$wrk = explode("||", $wrk);
			$this->setSessionDropDownValue($wrk, @$filter["z_bussiness_name"], "bussiness_name");
			$restoreFilter = TRUE;
		}
		if (!$restoreFilter) { // Clear filter
			$this->setSessionDropDownValue(INIT_VALUE, "", "bussiness_name");
		}

		// Field categoryname
		$restoreFilter = FALSE;
		if (array_key_exists("x_categoryname", $filter)) {
			$wrk = $filter["x_categoryname"];
			if (strpos($wrk, "||") !== FALSE)
				$wrk = explode("||", $wrk);
			$this->setSessionDropDownValue($wrk, @$filter["z_categoryname"], "categoryname");
			$restoreFilter = TRUE;
		}
		if (!$restoreFilter) { // Clear filter
			$this->setSessionDropDownValue(INIT_VALUE, "", "categoryname");
		}

		// Field subcategoryname
		$restoreFilter = FALSE;
		if (array_key_exists("x_subcategoryname", $filter)) {
			$wrk = $filter["x_subcategoryname"];
			if (strpos($wrk, "||") !== FALSE)
				$wrk = explode("||", $wrk);
			$this->setSessionDropDownValue($wrk, @$filter["z_subcategoryname"], "subcategoryname");
			$restoreFilter = TRUE;
		}
		if (!$restoreFilter) { // Clear filter
			$this->setSessionDropDownValue(INIT_VALUE, "", "subcategoryname");
		}
		return TRUE;
	}

	// Setup lookup options
	public function setupLookupOptions($fld)
	{
		if ($fld->Lookup !== NULL && $fld->Lookup->Options === NULL) {

			// No need to check any more
			$fld->Lookup->Options = [];

			// Set up lookup SQL
			switch ($fld->FieldVar) {
				default:
					$lookupFilter = "";
					break;
			}

			// Always call to Lookup->getSql so that user can setup Lookup->Options in Lookup_Selecting server event
			$sql = $fld->Lookup->getSql(FALSE, "", $lookupFilter, $this);

			// Set up lookup cache
			if ($fld->UseLookupCache && $sql <> "" && count($fld->Lookup->Options) == 0) {
				$conn = &$this->getConnection();
				$totalCnt = $this->getRecordCount($sql);
				if ($totalCnt > $fld->LookupCacheCount) // Total count > cache count, do not cache
					return;
				$rs = $conn->execute($sql);
				$ar = [];
				while ($rs && !$rs->EOF) {
					$row = &$rs->fields;

					// Render lookup
					$this->RowType == ROWTYPE_VIEW;
					$fn = $fld->Lookup->RenderViewFunc;
					$render = method_exists($this, $fn);

					// Format the field values
					$fld->setDbValue($row[1]);
					if ($render) {
						$this->$fn();
						$row[1] = $fld->ViewValue;
						$row['df'] = $row[1];
					} elseif ($fld->isEncrypt()) {
						$row[1] = $fld->CurrentValue;
					}
					$ar[strval($row[0])] = $row;
					$rs->moveNext();
				}
				if ($rs)
					$rs->close();
				$fld->Lookup->Options = $ar;
			}
		}
	}

	// Return popup filter
	protected function getPopupFilter()
	{
		$wrk = "";
		if ($this->DrillDown)
			return "";
		return $wrk;
	}

	// Page Load event
	function Page_Load() {

		//echo "Page Load";
	}

	// Page Unload event
	function Page_Unload() {

		//echo "Page Unload";
	}

	// Message Showing event
	// $type = ''|'success'|'failure'|'warning'
	function Message_Showing(&$msg, $type) {
		if ($type == 'success') {

			//$msg = "your success message";
		} elseif ($type == 'failure') {

			//$msg = "your failure message";
		} elseif ($type == 'warning') {

			//$msg = "your warning message";
		} else {

			//$msg = "your message";
		}
	}

	// Page Render event
	function Page_Render() {

		//echo "Page Render";
	}

	// Page Data Rendering event
	function Page_DataRendering(&$header) {

		// Example:
		//$header = "your header";

	}

	// Page Data Rendered event
	function Page_DataRendered(&$footer) {

		// Example:
		//$footer = "your footer";

	}

	// Form Custom Validate event
	function Form_CustomValidate(&$CustomError) {

		// Return error message in CustomError
		return TRUE;
	}
}
?>