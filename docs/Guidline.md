# Guideline to tests

## 001 Simple Ascertainment
### Test
Tests/Unit/Void/VoidTest.php
### System under test
None
### Purpose
Show, that
- the TYPO3 Testing Framework runs 3 assertions in the tearDown method on its own
- each testing method calls the setUp and tearDown methods (because it tells us that 8 assertions have been made)
- Explain difference between $this->assert and self::assert
## 002 How to test a model
### Test
Tests/Unit/Domain/Model/UserTest.php
### System under test
packages/theme/Classes/Domain/Model/User.php
### Purpose
Show,
- that model getters and setters can be tested quickly. If it's necessary and reasonable (!)
- that there are other possibilities that can be tested within a model
- how to test an image within the model. Explain use of Stub.
## 003 How to mock dependencies
### Test
packages/theme/Tests/Unit/Service/CustomDate/CustomDatePrinterTest.php
### System under test
packages/theme/Classes/Service/CustomDate/CustomDatePrinter.php
### Purpose
Show
- what AAA means (Arrange, Act, Assert)
- how a dependency (DI) can be mocked
- how a fake a class instead of mocking it in packages/theme/Tests/Unit/Service/CustomDate/CustomDatePrinterFakeInsteadMockTest.php
## 004 Set an Environment and use DataProviders
### Test
Tests/Unit/ViewHelpers/Context/ProductionLiveViewHelperTest.php
### System under test
packages/theme/Classes/ViewHelpers/Context/ProductionLiveViewHelper.php
### Purpose
Show,
- that the static Environment class can be simply "created"/initialised
- how a closure can be faked. Call "$renderChildrenClosure();" and show, how UnitTestCase::fail() can be called within the closure.
- how a DataProvider works
- the difference between a Dummy, a Stub and a Mock
## 005 Test a controller
### Test
packages/theme/Tests/Unit/Controller/UserControllerTest.php
### System under test
packages/theme/Classes/Controller/UserController.php
### Purpose
Show,
- controller can be tested
- how to mock a view (here the sut is mocked (even it is the sut!), because $view is protected)
- that we use a getAccessibleMock to mock the protected method of the sut
- that the `assertInstanceOf` in `isActionController` method does not need a mock for the repository, because the test does not call any method in the sut
## 006 Mock FAL
### Test
packages/theme/Tests/Unit/ViewHelpers/FalViewHelperTest.php
### System under test
packages/theme/Classes/ViewHelpers/FalViewHelper.php
### Purpose
Show,
- how to mock  a static class (GeneralUtility::makeInstance), when to use GeneralUtility::setSingletonInstance() and when GeneralUtility::addInstance()
- that within TYPO3 Files are seldomly mocked, because they are most of the time file references
- here the files don't even have to be mocked, because also `$fileReferences = []` without any file mocks does the trick.
## 007 Fake files
### Test
packages/theme/Tests/Unit/ViewHelpers/Render/InlineSvgViewHelperTest.php
### System under test
packages/theme/Classes/ViewHelpers/Render/InlineSvgViewHelper.php
### Purpose
Show,
- not so good developed ViewHelper
- that with testing of one method (renderStatic) a lot of other methods can be tested too. They do not have to be tested after each other.
## 008 Test DataProcessor
### Test
packages/theme/Tests/Unit/DataProcessing/OrganisersMenuProcessorTest.php
### System under test
packages/theme/Classes/DataProcessing/OrganisersMenuProcessor.php
### Purpose
Show,
- how to test a DataProcessor
- how an array ($processedData) is handed over and changed within the DataProcessor
## 009 Test DownloadService
### Test
packages/theme/Tests/Unit/Service/Download/DownloadsServiceTest.php
### System under test
packages/theme/Classes/Service/Download/DownloadsService.php
### Purpose
Show,
- what to do with a logger
- how to mock database requests
- how the try/catch block can be triggered by returning `$files->->willReturn(self::throwException(new \Exception()));`
