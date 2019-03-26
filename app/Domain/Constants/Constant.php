<?php
/**
 * Created by PhpStorm.
 * User: abdelrahmanbadr
 * Date: 3/20/19
 * Time: 11:50 AM
 */

namespace App\Domain\Constants;


class Constant
{

    const DEFAULT_DIRECTION = "asc";
    const DESC_DIRECTION = "desc";

    const QUERY_PARAMETER_FILTER = "filters";
    const QUERY_PARAMETER_SORT = "sort";
    const QUERY_PARAMETER_SEARCH = "search";
    const QUERY_PARAMETER_SEARCH_FIELDS = "searchFields";

    const QUERY_PARAMETER_EXPORT_TYPE = "type";
    const QUERY_PARAMETER_EXPORT_FIELDS = "fields";

    const EXCEL_EXPORT = "csv";
    const XML_EXPORT = "xml";

    const EXCEL_SHEET_BOOKS_TITLE = "Books List";

    const FILE_PATH_EXCEL_BOOKS = "exports/csv/books";
    const FILE_PATH_XML_BOOKS = "exports/xml/books";
}