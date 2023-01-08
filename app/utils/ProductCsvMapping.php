<?php
namespace App\Utils;

class ProductCsvMapping
{
    const PRODUCT_COLUMN_MAPPING = [
        "Product Name" => BaseConstants::NAME,
        "Net Weight" => BaseConstants::WEIGHT,
        "Style Code" => BaseConstants::STYLE_CODE,
        "Fabric" => BaseConstants::FABRIC,
        "Collar" => BaseConstants::COLLAR,
        "Pattern Type" => BaseConstants::PATTERN_TYPE,
        "Neck" => BaseConstants::NECK,
        "Solid" => BaseConstants::SOLID,
        "Sleeve Length" => BaseConstants::SLEEVE_LENGTH,
        "Country Of Origin" => BaseConstants::COUNTRY_ORIGIN,
        "Packer Details" => BaseConstants::PACKERS_DETAILS,
        "Seller Price" => BaseConstants::SELLER_PRICE,
        "MRP" => BaseConstants::MRP,
        "GST" => BaseConstants::GST,
        "Brand" => BaseConstants::BRAND,
        "Fit/Shape" => BaseConstants::FIT_SHAPE,
        "Length" => BaseConstants::LENGTH,
        "Occasion" => BaseConstants::OCCASION,
        "Description" => BaseConstants::DESCRIPTION,
        "Size" => BaseConstants::SIZE,
        "Color" => BaseConstants::COLOR,
        "Image Url" => BaseConstants::IMAGE_URL,
        "SKU Id" => BaseConstants::SKU_ID,
        "Quantity" => BaseConstants::QUANTITY
    ];

    const REQUIRED_ATTRIBUTES = [
        "Product Name",
        "Net Weight",
        "Country Of Origin",
        "Packer Details",
        "Seller Price",
        "MRP",
        "Brand",
        "Description",
        "Image Url",
        "SKU Id",
        "Quantity"
    ];

    const VARIANT_VALIDATION = [
        "Size",
        "Color"
    ];
}