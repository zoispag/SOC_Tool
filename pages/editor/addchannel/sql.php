INSERT INTO channels
( ChannelIP, ChannelListNo, ChannelLogo, ChannelName, ChannelPlatform, ChannelQuality, ChannelHDCP, ChannelEncryption, ChannelBouquet)
VALUES
( '225.10.11.13', '702', '225.10.11.13', 'BBC World News', 'Ericsson', 'SD', 'Disabled', 'Unencrypted', 'News' ),
( '225.10.11.66', '704', '225.10.11.66', 'Deutsche Welle', 'Ericsson', 'SD', 'Disabled', 'Unencrypted', 'News' ),
( '225.10.11.7', '705', '225.10.11.7', 'France 24 En', 'Ericsson', 'SD', 'Disabled', 'Unencrypted', 'News' ),
( '225.10.11.23', '706', '225.10.11.23', 'France 24 Fr', 'Ericsson', 'SD', 'Disabled', 'Unencrypted', 'News' ),
( '225.10.11.6', '707', '225.10.11.6', 'Al Jazeera', 'Ericsson', 'SD', 'Disabled', 'Unencrypted', 'News' ),
( '225.10.11.27', '709', '225.10.11.27', 'Russia Today', 'Ericsson', 'SD', 'Disabled', 'Unencrypted', 'News' ),
( '225.10.11.12', '710', '225.10.11.12', 'Bloomberg', 'Ericsson', 'SD', 'Disabled', 'Unencrypted', 'News' ),
( '225.10.11.10', '711', '225.10.11.10', 'CNBC', 'Ericsson', 'SD', 'Disabled', 'Unencrypted', 'News' )

INSERT INTO packages
( ChannelIP, FamilyPack, CinemaPack, SportsPack, FullPackLight, FullPack, AdultAddOn, OPAP, XoroiEstiasis, XoroiEstiasisNoSport)
VALUES
( '225.10.11.120', '0', '0', '0', '0', '0', '1', '0', '0', '0' ),
( '225.10.11.190', '0', '0', '0', '0', '0', '1', '0', '0', '0' ),
( '225.10.12.120', '0', '0', '0', '0', '0', '1', '0', '0', '0' ),
( '225.10.12.190', '0', '0', '0', '0', '0', '1', '0', '0', '0' ),
( '225.10.11.223', '0', '0', '0', '0', '0', '1', '0', '0', '0' ),
( '225.10.11.182', '0', '0', '0', '0', '0', '1', '0', '0', '0' ),
( '225.10.12.223', '0', '0', '0', '0', '0', '1', '0', '0', '0' ),
( '225.10.12.182', '0', '0', '0', '0', '0', '1', '0', '0', '0' ),
( '225.10.11.40', '0', '0', '0', '0', '0', '1', '0', '0', '0' ),
( '225.10.11.186', '0', '0', '0', '0', '0', '1', '0', '0', '0' ),
( '225.10.12.40', '0', '0', '0', '0', '0', '1', '0', '0', '0' ),
( '225.10.11.46', '0', '0', '0', '0', '0', '1', '0', '0', '0' ),
( '225.10.12.46', '0', '0', '0', '0', '0', '1', '0', '0', '0' )

INSERT INTO channels
( ChannelIP, ChannelListNo, ChannelLogo, ChannelName, ChannelPlatform, ChannelQuality, ChannelHDCP, ChannelEncryption, ChannelBouquet)
VALUES
( '(n)225.10.11.185', '702', '225.10.11.185', 'OTE Cinema House of Cards', 'Ericsson', 'SD', 'Disabled', 'Encrypted', 'Movies' ),
( '(n)225.10.12.185', '702', '225.10.12.185', 'OTE Cinema House of Cards', 'Huawei', 'SD', 'Enabled', 'Encrypted', 'Movies' ),
( '(n)225.10.11.55', '702', '225.10.11.55', 'OTE Cinema House of Cards', 'Ericsson', 'HD', 'Disabled', 'Encrypted', 'Movies' ),
( '(n)225.10.12.55', '702', '225.10.12.55', 'OTE Cinema House of Cards', 'Huawei', 'HD', 'Enabled', 'Encrypted', 'Movies' )

INSERT INTO packages
( ChannelIP, FamilyPack, CinemaPack, SportsPack, FullPackLight, FullPack, AdultAddOn, OPAP, XoroiEstiasis, XoroiEstiasisNoSport)
VALUES
( '225.10.11.185', '0', '1', '0', '1', '1', '0', '0', '0', '0' ),
( '225.10.12.185', '0', '1', '0', '1', '1', '0', '0', '0', '0' ),
( '225.10.11.55', '0', '1', '0', '1', '1', '0', '0', '0', '0' ),
( '225.10.12.55', '0', '1', '0', '1', '1', '0', '0', '0', '0' )