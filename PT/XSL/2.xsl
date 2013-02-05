<xsl:stylesheet version='1.0' xmlns:p="http://competec.ch/product"
                xmlns:xsl="http://www.w3.org/1999/XSL/Transform"
                exclude-result-prefixes="p">
    <xsl:output indent="yes" />
    <xsl:template match="/">
        <div>
            <xsl:apply-templates select="//p:price">
                <xsl:sort order="ascending" data-type="number" select="@value"/>
            </xsl:apply-templates>
        </div>
    </xsl:template>
    <xsl:template match="p:price[@class='enduser']">
       <strong><xsl:value-of select="@value"/></strong>
    </xsl:template>
    <xsl:template match="p:price">
       <p><xsl:value-of select="@value"/></p>
    </xsl:template>
</xsl:stylesheet>