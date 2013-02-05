<xsl:stylesheet version="1.0" xmlns:xsl="http://www.w3.org/1999/XSL/Transform" xmlns:ex="http://competec.ch/product" xmlns:img="http://competec.ch/images" exclude-result-prefixes="ex">
	<xsl:output encoding="UTF-8" indent="yes" method="xml" />
	<xsl:template match="/">
		<div>
			<xsl:apply-templates select="//ex:price[@value &gt; 700]">
				<xsl:sort order="descending" select="@value" data-type="number" />
			</xsl:apply-templates>	
		</div>
	</xsl:template>
	<xsl:template match="ex:price">
		<div><xsl:value-of select="@value" /><xsl:apply-templates select="//img:images" /></div><xsl:text>&#10;</xsl:text>
	</xsl:template>
	<xsl:template match="ex:price[@class = 'enduser']">
		<div><strong><xsl:value-of select="@value" /></strong><xsl:apply-templates select="//img:images" /></div><xsl:text>&#10;</xsl:text>
	</xsl:template>
	<xsl:template match="//img:images/img:image/img:size">
		<xsl:if test="starts-with(@variant,'xx') and not(starts-with(@variant,'xxx'))"><div><xsl:value-of select="@src" /></div></xsl:if>
	</xsl:template>
</xsl:stylesheet>