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
    const QUERY_PARAMETER_EXPORT_TYPE = "type";
    const QUERY_PARAMETER_EXPORT_FIELDS = "fields";

    const EXCEL_EXPORT = "csv";
    const XML_EXPORT = "xml";

    const EXCEL_SHEET_TITLE_BOOKS_TITLE_AND_AUTHOR = "Books titles with authors";
    const EXCEL_SHEET_TITLE_BOOKS_TITLE_ONLY = "Books titles";
    const EXCEL_SHEET_TITLE_BOOKS_AUTHORS_ONLY = "Books authors";
    const FILE_PATH_BOOKS_TITLE_AND_AUTHOR = "exports/books_titles_authors";
    const FILE_PATH_BOOKS_TITLE_ONLY = "exports/books_titles";
    const FILE_PATH_BOOKS_AUTHORS_ONLY = "exports/books_authors";
}