<?php
namespace App\Utils;

class BaseConstants
{
    const USER_TABLE = "users";
    const VENDOR_TABLE = "vendors";
    const CATEGORY_TABLE = "categories";

    // Category Fields
    const CATEGORY_NAME = "cname";
    const CATEGORY_DESCRIPTION = "desc";
    const CATEGORY_IMAGE = "categoryimage";
    const CATEGORY_ID = "category";

    // Vendor/User Fields
    const NAME = "name";
    const EMAIL = "email";
    const PASSWORD = "password";
    const PHONE = "phone_number";

    const AADHAR = "aadhar";
    const PANCARD = "pancard";
    const GST = "gst";
    const CURRENT_ACCOUNT = "current_account_number";
    const CHEQUE = "cheque";
    const PHOTO = "photo";
    const SIGNATURE = "signature";

    const CANCELCHEQUE = "cancelcheque";
    const SIGN = "sign";
    const CACCOUNT = "caccountnumber";
    const UNAME = "uname";
    const UEMAIL = "uemail";
    const UPHONE = "uphone";
    const UPASS = "upass";

    const EXTRA_AMOUNT=50;
    const MINIMUM_QUANTITY=100;


    const DESCRIPTION = "description";
    const VENDOR_ID = "vendor_id";
    const MRP = "mrp";
    const COLLAR = "collar";
    const SELLER_PRICE = "seller_price";
    const BRAND = "brand";
    const WEIGHT = "weight";
    const STYLE_CODE = "style_code";
    const FABRIC = "fabric";
    const SLEEVE_LENGTH = "sleeve_length";
    const COUNTRY_ORIGIN = "country_origin";
    const FIT_SHAPE = "fit_shape";
    const OCCASION = "occasion";
    const PATTERN_TYPE= "pattern_type";
    const PACKERS_DETAILS = "packers_detail";
    const SIZE = "size";
    const COLOR = "color";
    const NECK = "neck";
    const SOLID = "solid";
    const LENGTH = "length";
    const SKU_ID = "skuId";
    const QUANTITY = "quantity";
    const IMAGE_URL = "image_url";

    const BULK_UPLOAD_URL = ROOT."images.php?filename=";
}