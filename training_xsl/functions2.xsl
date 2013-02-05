<?xml version="1.0" ?>
<xsl:stylesheet version="1.0"
                xmlns:prod="http://competec.ch/product"
                xmlns:fun="my:fun"
                xmlns:func="http://exslt.org/functions"
                xmlns:exsl="http://exslt.org/common"
                extension-element-prefixes="func fun exsl"
                xmlns:xsl="http://www.w3.org/1999/XSL/Transform">

    <xsl:template match="/">
        <xsl:for-each select="fun:test()//bar">
            <xsl:value-of select="@id" />
        </xsl:for-each>
    </xsl:template>
    
    <func:function name="fun:test">
        <xsl:variable name="tmp">
            <foo>
                <bar id="1" />
                <bar id="2" />
            </foo>
        </xsl:variable>
        <func:result select="exsl:node-set($tmp)" />    
    </func:function>

</xsl:stylesheet> 
