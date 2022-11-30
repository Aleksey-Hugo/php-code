<?php
class PersonRegistrationEventSubscriber
{
    #[Asynchronous("asynchronous_messages")]
    #[EventHandler]
    public function sendWelcomeEmail(PersonWasRegistered $event, EmailSender $emailSender): void
    {
        $person = $this->userRepository->getById($event->getPersonId());
        $emailSender->sendWelcomeTo($person);
    }

    #[Asynchronous("asynchronous_messages")]
    #[EventHandler]
    public function synchronizeExternalService(PersonWasRegistered $event, ExternalIntegratedService $externalService): void
    {
        $person = $this->userRepository->getById($event->getPersonId());
        $externalService->synchronizeUser($person);
    }
}
