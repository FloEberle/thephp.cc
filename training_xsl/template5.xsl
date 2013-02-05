<xsl:stylesheet version="1.0" xmlns:xsl="http://www.w3.org/1999/XSL/Transform">

    <xsl:template match="/">
        <div>
            <xsl:call-template name="showName" />
            <xsl:for-each select="//description">
                <xsl:sort order="ascending" select="@type" />
                <xsl:call-template name="showDesc" />
            </xsl:for-each>
        </div>
    </xsl:template>

    <xsl:template name="showName">
        <p>hallo <xsl:value-of select="/product/@name" /></p>
    </xsl:template>

    <xsl:template name="showDesc">
        <p>Beschreibung: <xsl:value-of select="@type" /> - <xsl:value-of select="." /></p>
    </xsl:template>

</xsl:stylesheet>