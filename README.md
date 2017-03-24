**Attenion: This is not a complete working extension!**

This files represent a way to fix an issue when a Content Element created by EXT:mask_export which uses inline children is used together with EXT:gridelements. If such an element is edited in the backend, then the itemsProcFuncions from gridelements must be prevented otherwise your inline-children will not be displayed correctly.

The addition of a TSConfig-Option also gives control about which CTypes will be allowed as inline-children of your exported CE.

This is just a simple demonstration on how to fix the (rare) problem if the aforementioned circumstances are met. 

The important/critical additions are:

- Classes/ItemsProcFunctions/*
- Configuration/TCA/Overrides/tt_content.php
