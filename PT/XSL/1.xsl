<xsl:stylesheet version='1.0' xmlns:p="http://competec.ch/product" xmlns:xsl="http://www.w3.org/1999/XSL/Transform">
    <xsl:template match="/">
        <xsl:for-each select="//p:price">
            <xsl:sort order="ascending" data-type="number" select="@value" />
                <xsl:call-template name="showPrices" />
        </xsl:for-each>
    </xsl:template>
    <xsl:template name="showPrices">
       Preis <xsl:value-of select="@value"/>
    </xsl:template>
</xsl:stylesheet>