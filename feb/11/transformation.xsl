<xsl:stylesheet version="1.0" xmlns:xsl="http://www.w3.org/1999/XSL/Transform"
                xmlns:product="http://competec.ch/product"
                xmlns:images="http://competec.ch/images"
                xmlns:fun="my-fun"
                xmlns:func="http://exslt.org/functions"
                extension-element-prefixes="func"
                exclude-result-prefixes="product images">

    <xsl:output encoding="UTF-8" indent="yes" method="xml" />

    <func:function name="fun:averagePrice">
        <func:result select="sum(//product:price/@value) div count(//product:price)" />
    </func:function>

    <xsl:template match="/">
    <div>
        <xsl:value-of select="fun:averagePrice()" />
    </div>
    </xsl:template>

</xsl:stylesheet>