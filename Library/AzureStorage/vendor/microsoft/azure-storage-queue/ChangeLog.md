2021.09 - version 1.3.4
* Upgraded dependency for `azure-storage-common` to version 1.5.2.

2020.12 - version 1.3.3
* Guzzle version is now updated to support both 6.x and 7.x.

2020.08 - version 1.3.2
* Lower case query parameter names.

2020.01 - version 1.3.1
* Fixed the issue in SAS token where special characters were not correctly encoded.

2019.04 - version 1.3.0
* Added support for OAuth authentication.
* Resolved some issues on Linux platform.

2019.03 - version 1.2.0
* Documentation refinement.

2018.08 - version 1.1.1

* Fixed a bug in documents that `getMessageId` method should return string instead of integer.

2018.04 - version 1.1.0

* MD files are modified for better readability and formatting.
* CACERT can now be set when creating RestProxies using `$options` parameter.
* Removed unnecessary trailing spaces.
* Assertions are re-factored in test cases.
* Now the test framework uses `PHPUnit\Framework\TestCase` instead of `PHPUnit_Framework_TestCase`.

2018.01 - version 1.0.0

* Created `QueueSharedAccessSignatureHelper` and moved method `SharedAccessSignatureHelper::generateQueueServiceSharedAccessSignatureToken()` into `QueueSharedAccessSignatureHelper`.
* Added static builder methods `createQueueService` into `QueueRestProxy`.
* Removed `dataSerializer` parameter from `QueueRextProxy` constructor.
* Deprecated PHP 5.5 support.