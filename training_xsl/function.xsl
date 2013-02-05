<?xml version="1.0" ?>
<xsl:stylesheet version="1.0"
                xmlns:prod="http://competec.ch/product"
                xmlns:fun="my:fun"
                xmlns:func="http://exslt.org/functions"
                extension-element-prefixes="func mathbgfun"
                xmlns:xsl="http://www.w3.org/1999/XSL/Transform">

    <xsl:template match="/">
        <xsl:value-of select="fun:avgPrice()" />
    </xsl:template>
    
    <func:function name="fun:avgPrice">
        <func:result select="sum(//prod:price/@value) div count(//prod:price)" />
    </func:function>

</xsl:stylesheet> 
