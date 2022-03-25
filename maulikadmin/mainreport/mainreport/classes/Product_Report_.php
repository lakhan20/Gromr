<?php
namespace PHPReportMaker12\project1;

/**
 * Table class for Product Report 
 */
class Product_Report_ extends ReportTable
{
	public $ShowGroupHeaderAsRow = FALSE;
	public $ShowCompactSummaryFooter = TRUE;
	public $idproduct;
	public $pname;
	public $brand;
	public $MRP;
	public $price;
	public $description;
	public $bussiness_name;
	public $email_id;
	public $categoryname;
	public $subcategoryname;

	// Constructor
	public function __construct()
	{
		global $ReportLanguage, $CurrentLanguage;

		// Language object
		if (!isset($ReportLanguage))
			$ReportLanguage = new ReportLanguage();
		$this->TableVar = 'Product_Report_';
		$this->TableName = 'Product Report ';
		$this->TableType = 'REPORT';
		$this->TableReportType = 'summary';
		$this->SourceTableIsCustomView = FALSE;
		$this->Dbid = 'DB';
		$this->ExportAll = FALSE;
		$this->ExportPageBreakCount = 0;

		// idproduct
		$this->idproduct = new ReportField('Product_Report_', 'Product Report ', 'x_idproduct', 'idproduct', '`idproduct`', 3, -1, FALSE, 'FORMATTED TEXT', 'NO');
		$this->idproduct->Sortable = TRUE; // Allow sort
		$this->idproduct->DefaultErrorMessage = $ReportLanguage->phrase("IncorrectInteger");
		$this->idproduct->DateFilter = "";
		$this->fields['idproduct'] = &$this->idproduct;

		// pname
		$this->pname = new ReportField('Product_Report_', 'Product Report ', 'x_pname', 'pname', '`pname`', 200, -1, FALSE, 'FORMATTED TEXT', 'SELECT');
		$this->pname->Sortable = TRUE; // Allow sort
		$this->pname->UsePleaseSelect = TRUE; // Use PleaseSelect by default
		$this->pname->PleaseSelectText = $ReportLanguage->phrase("PleaseSelect"); // PleaseSelect text
		$this->pname->DateFilter = "";
		$this->pname->Lookup = new ReportLookup('pname', 'Product_Report_', TRUE, 'pname', ["pname","","",""], [], [], [], [], [], [], '`pname` ASC', '');
		$this->pname->Lookup->RenderViewFunc = "renderLookup";
		$this->fields['pname'] = &$this->pname;

		// brand
		$this->brand = new ReportField('Product_Report_', 'Product Report ', 'x_brand', 'brand', '`brand`', 200, -1, FALSE, 'FORMATTED TEXT', 'SELECT');
		$this->brand->Sortable = TRUE; // Allow sort
		$this->brand->UsePleaseSelect = TRUE; // Use PleaseSelect by default
		$this->brand->PleaseSelectText = $ReportLanguage->phrase("PleaseSelect"); // PleaseSelect text
		$this->brand->DateFilter = "";
		$this->brand->Lookup = new ReportLookup('brand', 'Product_Report_', TRUE, 'brand', ["brand","","",""], [], [], [], [], [], [], '`brand` ASC', '');
		$this->brand->Lookup->RenderViewFunc = "renderLookup";
		$this->fields['brand'] = &$this->brand;

		// MRP
		$this->MRP = new ReportField('Product_Report_', 'Product Report ', 'x_MRP', 'MRP', '`MRP`', 131, -1, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->MRP->Sortable = TRUE; // Allow sort
		$this->MRP->DefaultErrorMessage = $ReportLanguage->phrase("IncorrectFloat");
		$this->MRP->DateFilter = "";
		$this->fields['MRP'] = &$this->MRP;

		// price
		$this->price = new ReportField('Product_Report_', 'Product Report ', 'x_price', 'price', '`price`', 131, -1, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->price->Sortable = TRUE; // Allow sort
		$this->price->DefaultErrorMessage = $ReportLanguage->phrase("IncorrectFloat");
		$this->price->DateFilter = "";
		$this->fields['price'] = &$this->price;

		// description
		$this->description = new ReportField('Product_Report_', 'Product Report ', 'x_description', 'description', '`description`', 201, -1, FALSE, 'FORMATTED TEXT', 'TEXTAREA');
		$this->description->Sortable = TRUE; // Allow sort
		$this->description->DateFilter = "";
		$this->fields['description'] = &$this->description;

		// bussiness_name
		$this->bussiness_name = new ReportField('Product_Report_', 'Product Report ', 'x_bussiness_name', 'bussiness_name', '`bussiness_name`', 200, -1, FALSE, 'FORMATTED TEXT', 'SELECT');
		$this->bussiness_name->Sortable = TRUE; // Allow sort
		$this->bussiness_name->UsePleaseSelect = TRUE; // Use PleaseSelect by default
		$this->bussiness_name->PleaseSelectText = $ReportLanguage->phrase("PleaseSelect"); // PleaseSelect text
		$this->bussiness_name->GroupingFieldId = 1;
		$this->bussiness_name->ShowGroupHeaderAsRow = $this->ShowGroupHeaderAsRow;
		$this->bussiness_name->ShowCompactSummaryFooter = $this->ShowCompactSummaryFooter;
		$this->bussiness_name->DateFilter = "";
		$this->bussiness_name->Lookup = new ReportLookup('bussiness_name', 'Product_Report_', TRUE, 'bussiness_name', ["bussiness_name","","",""], [], [], [], [], [], [], '`bussiness_name` ASC', '');
		$this->bussiness_name->Lookup->RenderViewFunc = "renderLookup";
		$this->bussiness_name->GroupByType = "";
		$this->bussiness_name->GroupInterval = "0";
		$this->bussiness_name->GroupSql = "";
		$this->fields['bussiness_name'] = &$this->bussiness_name;

		// email_id
		$this->email_id = new ReportField('Product_Report_', 'Product Report ', 'x_email_id', 'email_id', '`email_id`', 200, -1, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->email_id->Sortable = TRUE; // Allow sort
		$this->email_id->DateFilter = "";
		$this->fields['email_id'] = &$this->email_id;

		// categoryname
		$this->categoryname = new ReportField('Product_Report_', 'Product Report ', 'x_categoryname', 'categoryname', '`categoryname`', 200, -1, FALSE, 'FORMATTED TEXT', 'SELECT');
		$this->categoryname->Sortable = TRUE; // Allow sort
		$this->categoryname->UsePleaseSelect = TRUE; // Use PleaseSelect by default
		$this->categoryname->PleaseSelectText = $ReportLanguage->phrase("PleaseSelect"); // PleaseSelect text
		$this->categoryname->GroupingFieldId = 2;
		$this->categoryname->ShowGroupHeaderAsRow = $this->ShowGroupHeaderAsRow;
		$this->categoryname->ShowCompactSummaryFooter = $this->ShowCompactSummaryFooter;
		$this->categoryname->DateFilter = "";
		$this->categoryname->Lookup = new ReportLookup('categoryname', 'Product_Report_', TRUE, 'categoryname', ["categoryname","","",""], [], [], [], [], [], [], '`categoryname` ASC', '');
		$this->categoryname->Lookup->RenderViewFunc = "renderLookup";
		$this->categoryname->GroupByType = "";
		$this->categoryname->GroupInterval = "0";
		$this->categoryname->GroupSql = "";
		$this->fields['categoryname'] = &$this->categoryname;

		// subcategoryname
		$this->subcategoryname = new ReportField('Product_Report_', 'Product Report ', 'x_subcategoryname', 'subcategoryname', '`subcategoryname`', 200, -1, FALSE, 'FORMATTED TEXT', 'SELECT');
		$this->subcategoryname->Sortable = TRUE; // Allow sort
		$this->subcategoryname->UsePleaseSelect = TRUE; // Use PleaseSelect by default
		$this->subcategoryname->PleaseSelectText = $ReportLanguage->phrase("PleaseSelect"); // PleaseSelect text
		$this->subcategoryname->GroupingFieldId = 3;
		$this->subcategoryname->ShowGroupHeaderAsRow = $this->ShowGroupHeaderAsRow;
		$this->subcategoryname->ShowCompactSummaryFooter = $this->ShowCompactSummaryFooter;
		$this->subcategoryname->DateFilter = "";
		$this->subcategoryname->Lookup = new ReportLookup('subcategoryname', 'Product_Report_', TRUE, 'subcategoryname', ["subcategoryname","","",""], [], [], [], [], [], [], '`subcategoryname` ASC', '');
		$this->subcategoryname->Lookup->RenderViewFunc = "renderLookup";
		$this->subcategoryname->GroupByType = "";
		$this->subcategoryname->GroupInterval = "0";
		$this->subcategoryname->GroupSql = "";
		$this->fields['subcategoryname'] = &$this->subcategoryname;
	}

	// Render for popup
	public function renderPopup()
	{
		global $ReportLanguage;
	}

	// Render for lookup
	public function renderLookup()
	{
		$this->pname->ViewValue = GetDropDownDisplayValue($this->pname->CurrentValue, "", 0);
		$this->brand->ViewValue = GetDropDownDisplayValue($this->brand->CurrentValue, "", 0);
		$this->bussiness_name->ViewValue = GetDropDownDisplayValue($this->bussiness_name->CurrentValue, "", 0);
		$this->categoryname->ViewValue = GetDropDownDisplayValue($this->categoryname->CurrentValue, "", 0);
		$this->subcategoryname->ViewValue = GetDropDownDisplayValue($this->subcategoryname->CurrentValue, "", 0);
	}

	// Get Field Visibility
	public function getFieldVisibility($fldparm)
	{
		global $Security;
		return $this->$fldparm->Visible; // Returns original value
	}

	// Single column sort
	protected function updateSort(&$fld)
	{
		if ($this->CurrentOrder == $fld->Name) {
			$sortField = $fld->Expression;
			$lastSort = $fld->getSort();
			if ($this->CurrentOrderType == "ASC" || $this->CurrentOrderType == "DESC") {
				$thisSort = $this->CurrentOrderType;
			} else {
				$thisSort = ($lastSort == "ASC") ? "DESC" : "ASC";
			}
			$fld->setSort($thisSort);
			if ($fld->GroupingFieldId == 0)
				$this->setDetailOrderBy($sortField . " " . $thisSort); // Save to Session
		} else {
			if ($fld->GroupingFieldId == 0) $fld->setSort("");
		}
	}

	// Get Sort SQL
	protected function sortSql()
	{
		$dtlSortSql = $this->getDetailOrderBy(); // Get ORDER BY for detail fields from session
		$argrps = [];
		foreach ($this->fields as $fld) {
			if ($fld->getSort() <> "") {
				$fldsql = $fld->Expression;
				if ($fld->GroupingFieldId > 0) {
					if ($fld->GroupSql <> "")
						$argrps[$fld->GroupingFieldId] = str_replace("%s", $fldsql, $fld->GroupSql) . " " . $fld->getSort();
					else
						$argrps[$fld->GroupingFieldId] = $fldsql . " " . $fld->getSort();
				}
			}
		}
		$sortSql = "";
		foreach ($argrps as $grp) {
			if ($sortSql <> "") $sortSql .= ", ";
			$sortSql .= $grp;
		}
		if ($dtlSortSql <> "") {
			if ($sortSql <> "") $sortSql .= ", ";
			$sortSql .= $dtlSortSql;
		}
		return $sortSql;
	}

	// Table level SQL
	private $_sqlFrom = "";
	private $_sqlSelect = "";
	private $_sqlWhere = "";
	private $_sqlGroupBy = "";
	private $_sqlHaving = "";
	private $_sqlOrderBy = "";

	// From
	public function getSqlFrom()
	{
		return ($this->_sqlFrom <> "") ? $this->_sqlFrom : "`all product`";
	}
	public function setSqlFrom($v)
	{
		$this->_sqlFrom = $v;
	}

	// Select
	public function getSqlSelect()
	{
		return ($this->_sqlSelect <> "") ? $this->_sqlSelect : "SELECT * FROM " . $this->getSqlFrom();
	}
	public function setSqlSelect($v)
	{
		$this->_sqlSelect = $v;
	}

	// Where
	public function getSqlWhere()
	{
		$where = ($this->_sqlWhere <> "") ? $this->_sqlWhere : "";
		$filter = "";
		AddFilter($where, $filter);
		return $where;
	}
	public function setSqlWhere($v)
	{
		$this->_sqlWhere = $v;
	}

	// Group By
	public function getSqlGroupBy()
	{
		return ($this->_sqlGroupBy <> "") ? $this->_sqlGroupBy : "";
	}
	public function setSqlGroupBy($v)
	{
		$this->_sqlGroupBy = $v;
	}

	// Having
	public function getSqlHaving()
	{
		return ($this->_sqlHaving <> "") ? $this->_sqlHaving : "";
	}
	public function setSqlHaving($v)
	{
		$this->_sqlHaving = $v;
	}

	// Order By
	public function getSqlOrderBy()
	{
		return ($this->_sqlOrderBy <> "") ? $this->_sqlOrderBy : "`bussiness_name` ASC, `categoryname` ASC, `subcategoryname` ASC";
	}
	public function setSqlOrderBy($v)
	{
		$this->_sqlOrderBy = $v;
	}

	// Get SQL
	public function getSql($where, $orderBy = "")
	{
		return BuildReportSql($this->getSqlSelect(), $this->getSqlWhere(),
			$this->getSqlGroupBy(), $this->getSqlHaving(), $this->getSqlOrderBy(),
			$where, $orderBy);
	}

	// Table Level Group SQL
	private $_sqlFirstGroupField = "";
	private $_sqlSelectGroup = "";
	private $_sqlOrderByGroup = "";

	// First Group Field
	public function getSqlFirstGroupField()
	{
		return ($this->_sqlFirstGroupField <> "") ? $this->_sqlFirstGroupField : "`bussiness_name`";
	}
	public function setSqlFirstGroupField($v)
	{
		$this->_sqlFirstGroupField = $v;
	}

	// Select Group
	public function getSqlSelectGroup()
	{
		return ($this->_sqlSelectGroup <> "") ? $this->_sqlSelectGroup : "SELECT DISTINCT " . $this->getSqlFirstGroupField() . " FROM " . $this->getSqlFrom();
	}
	public function setSqlSelectGroup($v)
	{
		$this->_sqlSelectGroup = $v;
	}

	// Order By Group
	public function getSqlOrderByGroup()
	{
		return ($this->_sqlOrderByGroup <> "") ? $this->_sqlOrderByGroup : "`bussiness_name` ASC";
	}
	public function setSqlOrderByGroup($v)
	{
		$this->_sqlOrderByGroup = $v;
	}

	// Summary properties
	private $_sqlSelectAggregate = "";
	private $_sqlAggregatePrefix = "";
	private $_sqlAggregateSuffix = "";
	private $_sqlSelectCount = "";

	// Select Aggregate
	public function getSqlSelectAggregate()
	{
		return ($this->_sqlSelectAggregate <> "") ? $this->_sqlSelectAggregate : "SELECT * FROM " . $this->getSqlFrom();
	}
	public function setSqlSelectAggregate($v)
	{
		$this->_sqlSelectAggregate = $v;
	}

	// Aggregate Prefix
	public function getSqlAggregatePrefix()
	{
		return ($this->_sqlAggregatePrefix <> "") ? $this->_sqlAggregatePrefix : "";
	}
	public function setSqlAggregatePrefix($v)
	{
		$this->_sqlAggregatePrefix = $v;
	}

	// Aggregate Suffix
	public function getSqlAggregateSuffix()
	{
		return ($this->_sqlAggregateSuffix <> "") ? $this->_sqlAggregateSuffix : "";
	}
	public function setSqlAggregateSuffix($v)
	{
		$this->_sqlAggregateSuffix = $v;
	}

	// Select Count
	public function getSqlSelectCount()
	{
		return ($this->_sqlSelectCount <> "") ? $this->_sqlSelectCount : "SELECT COUNT(*) FROM " . $this->getSqlFrom();
	}
	public function setSqlSelectCount($v)
	{
		$this->_sqlSelectCount = $v;
	}

	// Get record count
	public function getRecordCount($sql)
	{
		$cnt = -1;
		$rs = NULL;
		$sql = preg_replace('/\/\*BeginOrderBy\*\/[\s\S]+\/\*EndOrderBy\*\//', "", $sql); // Remove ORDER BY clause (MSSQL)
		$pattern = '/^SELECT\s([\s\S]+)\sFROM\s/i';

		// Skip Custom View / SubQuery and SELECT DISTINCT
		if (($this->TableType == 'TABLE' || $this->TableType == 'VIEW' || $this->TableType == 'LINKTABLE') &&
			preg_match($pattern, $sql) && !preg_match('/\(\s*(SELECT[^)]+)\)/i', $sql) && !preg_match('/^\s*select\s+distinct\s+/i', $sql)) {
			$sqlwrk = "SELECT COUNT(*) FROM " . preg_replace($pattern, "", $sql);
		} else {
			$sqlwrk = "SELECT COUNT(*) FROM (" . $sql . ") COUNT_TABLE";
		}
		$conn = &$this->getConnection();
		if ($rs = $conn->execute($sqlwrk)) {
			if (!$rs->EOF && $rs->FieldCount() > 0) {
				$cnt = $rs->fields[0];
				$rs->close();
			}
			return (int)$cnt;
		}

		// Unable to get count, get record count directly
		if ($rs = $conn->execute($sql)) {
			$cnt = $rs->RecordCount();
			$rs->close();
			return (int)$cnt;
		}
		return $cnt;
	}

	// Get recordset
	public function getRecordset($sql, $rowcnt = -1, $offset = -1)
	{
		$conn = &$this->getConnection();
		$conn->raiseErrorFn = $GLOBALS["ERROR_FUNC"];
		$rs = $conn->selectLimit($sql, $rowcnt, $offset);
		$conn->raiseErrorFn = '';
		return $rs;
	}

	// Sort URL
	public function sortUrl(&$fld)
	{
		global $DashboardReport;
		return "";
	}

	// Lookup data from table
	public function lookup()
	{

		// Load lookup parameters
		$distinct = ConvertToBool(Post("distinct"));
		$linkField = Post("linkField");
		$displayFields = Post("displayFields");
		$parentFields = Post("parentFields");
		if (!is_array($parentFields))
			$parentFields = [];
		$childFields = Post("childFields");
		if (!is_array($childFields))
			$childFields = [];
		$filterFields = Post("filterFields");
		if (!is_array($filterFields))
			$filterFields = [];
		$filterFieldVars = Post("filterFieldVars");
		if (!is_array($filterFieldVars))
			$filterFieldVars = [];
		$filterOperators = Post("filterOperators");
		if (!is_array($filterOperators))
			$filterOperators = [];
		$autoFillSourceFields = Post("autoFillSourceFields");
		if (!is_array($autoFillSourceFields))
			$autoFillSourceFields = [];
		$formatAutoFill = FALSE;
		$lookupType = Post("ajax", "unknown");
		$pageSize = -1;
		$offset = -1;
		$searchValue = "";
		if (SameText($lookupType, "modal")) {
			$searchValue = Post("sv", "");
			$pageSize = Post("recperpage", 10);
			$offset = Post("start", 0);
		} elseif (SameText($lookupType, "autosuggest")) {
			$searchValue = Get("q", "");
			$pageSize = Param("n", -1);
			$pageSize = is_numeric($pageSize) ? (int)$pageSize : -1;
			if ($pageSize <= 0)
				$pageSize = AUTO_SUGGEST_MAX_ENTRIES;
			$start = Param("start", -1);
			$start = is_numeric($start) ? (int)$start : -1;
			$page = Param("page", -1);
			$page = is_numeric($page) ? (int)$page : -1;
			$offset = $start >= 0 ? $start : ($page > 0 && $pageSize > 0 ? ($page - 1) * $pageSize : 0);
		}
		$userSelect = Decrypt(Post("s", ""));
		$userFilter = Decrypt(Post("f", ""));
		$userOrderBy = Decrypt(Post("o", ""));

		// Create lookup object and output JSON
		$lookup = new ReportLookup($linkField, $this->TableVar, $distinct, $linkField, $displayFields, $parentFields, $childFields, $filterFields, $filterFieldVars, $autoFillSourceFields);
		foreach ($filterFields as $i => $filterField) { // Set up filter operators
			if (@$filterOperators[$i] <> "")
				$lookup->setFilterOperator($filterField, $filterOperators[$i]);
		}
		$lookup->LookupType = $lookupType; // Lookup type
		if (Post("keys") !== NULL) { // Selected records from modal
			$keys = Post("keys");
			if (is_array($keys))
				$keys = implode(LOOKUP_FILTER_VALUE_SEPARATOR, $keys);
			$lookup->FilterValues[] = $keys; // Lookup values
		} else { // Lookup values
			$lookup->FilterValues[] = Post("v0", Post("lookupValue", ""));
		}
		$cnt = is_array($filterFields) ? count($filterFields) : 0;
		for ($i = 1; $i <= $cnt; $i++)
			$lookup->FilterValues[] = Post("v" . $i, "");
		$lookup->SearchValue = $searchValue;
		$lookup->PageSize = $pageSize;
		$lookup->Offset = $offset;
		if ($userSelect <> "")
			$lookup->UserSelect = $userSelect;
		if ($userFilter <> "")
			$lookup->UserFilter = $userFilter;
		if ($userOrderBy <> "")
			$lookup->UserOrderBy = $userOrderBy;
		$lookup->toJson();
	}

	// Get file data
	public function getFileData($fldparm, $key, $resize, $width = THUMBNAIL_DEFAULT_WIDTH, $height = THUMBNAIL_DEFAULT_HEIGHT)
	{

		// No binary fields
		return FALSE;
	}

	// Table level events
	// Page Selecting event
	function Page_Selecting(&$filter) {

		// Enter your code here
	}

	// Page Breaking event
	function Page_Breaking(&$break, &$content) {

		// Example:
		//$break = FALSE; // Skip page break, or
		//$content = "<div style=\"page-break-after:always;\">&nbsp;</div>"; // Modify page break content

	}

	// Row Rendering event
	function Row_Rendering() {

		// Enter your code here
	}

	// Cell Rendered event
	function Cell_Rendered(&$Field, $CurrentValue, &$ViewValue, &$ViewAttrs, &$CellAttrs, &$HrefValue, &$LinkAttrs) {

		//$ViewValue = "xxx";
		//$ViewAttrs["class"] = "xxx";

	}

	// Row Rendered event
	function Row_Rendered() {

		// To view properties of field class, use:
		//var_dump($this-><FieldName>);

	}

	// User ID Filtering event
	function UserID_Filtering(&$filter) {

		// Enter your code here
	}

	// Load Filters event
	function Page_FilterLoad() {

		// Enter your code here
		// Example: Register/Unregister Custom Extended Filter
		//RegisterFilter($this-><Field>, 'StartsWithA', 'Starts With A', PROJECT_NAMESPACE . 'GetStartsWithAFilter'); // With function, or
		//RegisterFilter($this-><Field>, 'StartsWithA', 'Starts With A'); // No function, use Page_Filtering event
		//UnregisterFilter($this-><Field>, 'StartsWithA');

	}

	// Page Filter Validated event
	function Page_FilterValidated() {

		// Example:
		//$this->MyField1->AdvancedSearch->SearchValue = "your search criteria"; // Search value

	}

	// Page Filtering event
	function Page_Filtering(&$fld, &$filter, $typ, $opr = "", $val = "", $cond = "", $opr2 = "", $val2 = "") {

		// Note: ALWAYS CHECK THE FILTER TYPE ($typ)! Example:
		//if ($typ == "dropdown" && $fld->Name == "MyField") // Dropdown filter
		//	$filter = "..."; // Modify the filter
		//if ($typ == "extended" && $fld->Name == "MyField") // Extended filter
		//	$filter = "..."; // Modify the filter
		//if ($typ == "popup" && $fld->Name == "MyField") // Popup filter
		//	$filter = "..."; // Modify the filter
		//if ($typ == "custom" && $opr == "..." && $fld->Name == "MyField") // Custom filter, $opr is the custom filter ID
		//	$filter = "..."; // Modify the filter

	}

	// Email Sending event
	function Email_Sending(&$email, &$args) {

		//var_dump($email); var_dump($args); exit();
		return TRUE;
	}

	// Lookup Selecting event
	function Lookup_Selecting($fld, &$filter) {

		// Enter your code here
	}
}
?>