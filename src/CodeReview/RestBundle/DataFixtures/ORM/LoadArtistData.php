<?php

namespace CodeReview\RestBundle\DataFixtures\ORM;

use CodeReview\RestBundle\Entity\Artist;
use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;

class LoadArtistData extends AbstractFixture implements OrderedFixtureInterface
{
    /**
     * {@inheritDoc}
     */
    public function load(ObjectManager $manager)
    {
        foreach ($this->getData() as $data) {

            $a = new Artist();
            $a->setName($data['name']);

            $manager->persist($a);
            $this->addReference($data['reference'], $a);

        }

        $manager->flush();
    }

    /**
     * {@inheritDoc}
     */
    public function getOrder()
    {
        return 100; // the order in which fixtures will be loaded
    }


    private function getData()
    {
        return array(
            array(
                'name' => 'The Beatles',
                'reference' => 'artist-1',
            ),
            array(
                'name' => 'The Rolling Stones',
                'reference' => 'artist-2',
            )
        );
    }
}