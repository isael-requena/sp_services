<?php
namespace App\Service;

use Symfony\Component\Serializer\Encoder\JsonEncoder;
use Symfony\Component\Serializer\Normalizer\AbstractNormalizer;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
use Symfony\Component\Serializer\Normalizer\DateTimeNormalizer;
use Symfony\Component\Serializer\Encoder\XmlEncoder;
use Symfony\Component\Serializer\Serializer;

class SerializerService {

  private $serializer;

  public function __construct() {
    $encoders = [new XmlEncoder(), new JsonEncoder()];
    $defaultContext = [
      AbstractNormalizer::CIRCULAR_REFERENCE_LIMIT => 1,
      AbstractNormalizer::CIRCULAR_REFERENCE_HANDLER => function ($object, $format, $context) {
        return $object->getId();
      },
    ];
    $normalizer = new ObjectNormalizer(null, null, null, null, null, null, $defaultContext);
    $normalizers = [new DateTimeNormalizer(), $normalizer];

    $this->serializer = new Serializer($normalizers, $encoders);
  }

  public function getSerializer() {
    return $this->serializer;
  }
}

?>