<xsl:stylesheet version="1.0" xmlns:xsl="http://www.w3.org/1999/XSL/Transform">

    <xsl:template match="/">
        <div>
            <xsl:apply-templates select="//description">
                <xsl:sort select="@type" order="ascending" />
            </xsl:apply-templates>
        </div>
    </xsl:template>

    <xsl:template match="description">
        <p>Beschreibung: <xsl:value-of select="@type" /> - <xsl:value-of select="." /></p>
    </xsl:template>

    <xsl:template match="description[@type='short']">
        <p>Kurzbeschreibung: <xsl:value-of select="." /></p>
    </xsl:template>

    <xsl:template match="description[@class='teaser']">
        <p>Teaser: <xsl:value-of select="." /></p>
    </xsl:template>


</xsl:stylesheet>