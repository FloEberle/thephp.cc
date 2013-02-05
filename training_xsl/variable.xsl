<?xml version="1.0" ?>
<xsl:stylesheet version="1.0"
                xmlns:prod="http://competec.ch/product"
                xmlns:fun="my:fun"
                xmlns:func="http://exslt.org/functions"
                xmlns:exslt="http://exslt.org/common"
                extension-element-prefixes="func fun exslt"
                xmlns:xsl="http://www.w3.org/1999/XSL/Transform">

    <xsl:template match="/">
        
        <xsl:variable name="tmp">
            <foo>
                <bar label="test" />
            </foo>
        </xsl:variable>
    
        <xsl:value-of select="exslt:node-set($tmp)//bar/@label" />
    </xsl:template>
    
</xsl:stylesheet>
