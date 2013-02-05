<xsl:stylesheet version="1.0" xmlns:xsl="http://www.w3.org/1999/XSL/Transform" xmlns:ex="http://competec.ch/product" exclude-result-prefixes="ex">
	<xsl:output encoding="UTF-8" indent="yes" method="xml" />
	<xsl:template match="/">
		<div>
				<xsl:apply-templates select="//ex:price">
					<xsl:sort order="descending" select="@value" data-type="number" />
				</xsl:apply-templates>	
		</div>
	</xsl:template>
	
	<xsl:template match="ex:price[@value&gt;700]">
		<div><xsl:value-of select="@value" /></div><xsl:text>&#10;</xsl:text>
	</xsl:template>
	
	<xsl:template match="ex:price[@class='enduser' and @value&gt;700]">
		<strong><xsl:value-of select="@value" /></strong><xsl:text>&#10;</xsl:text>
	</xsl:template>
	
</xsl:stylesheet>