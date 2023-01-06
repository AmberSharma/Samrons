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
}

//productdetails[category]: 1
//productdetails[category]: 0
//productdetails[mrp]: 500
//productdetails[seller_price]: 400
//productdetails[gst]: 12
//productdetails[name]: Shirt
//productdetails[brand]:
//productdetails[weight]:
//productdetails[style_code]:
//productdetails[fabric]:
//productdetails[collar]:
//productdetails[sleeve_length]:
//productdetails[country_origin]:
//productdetails[fit_shape]:
//productdetails[occasion]:
//productdetails[pattern_type]:
//productdetails[description]: test
//productdetails[packers_detail]:
//productdetails[options][18]: 1
//productdetails[optionvalues][19]: [{"value":"S"},{"value":"L"}]
//productdetails[options][20]: 2
//productdetails[optionvalues][21]: [{"value":"Black"},{"value":"Red"}]
//productdetails[valueCombination][22]: S,Black
//productdetails[skuId][23]:
//productdetails[quantity][24]:
//productdetails[valueCombination][25]: S,Red
//productdetails[skuId][26]:
//productdetails[quantity][27]:
//productdetails[valueCombination][28]: L,Black
//productdetails[skuId][29]:
//productdetails[quantity][30]:
//productdetails[valueCombination][31]: L,Red
//productdetails[skuId][32]:
//productdetails[quantity][33]: