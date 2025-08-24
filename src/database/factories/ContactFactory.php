<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Contact;
use App\Models\Category;

class ContactFactory extends Factory
{

    protected $model = Contact::class;
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        // 日本語対応
        $this->faker->locale('ja_JP');

        $detailsByCategory = [
            '商品のお届けについて' => [
                '注文した商品がまだ届いていません。配送状況を確認していただけますか？',
                'お届け予定日を教えてください。',
                '配送先住所を変更したいのですが可能でしょうか？',
            ],
            '商品の交換について' => [
                '届いた商品のサイズを交換したいです。',
                '注文した商品を別の色に交換できますか？',
                '不良品だったので交換をお願いしたいです。',
            ],
            '商品トラブル' => [
                '商品が正常に動作しません。',
                '購入した商品に傷がありました。',
                '商品の一部が不足していました。',
            ],
            'ショップへのお問い合わせ' => [
                'ショップの営業時間を教えてください。',
                '支払い方法について質問があります。',
                'ショップの場所を教えていただけますか？',
            ],
            'その他' => [
                'その他のお問い合わせです。',
                '特にカテゴリに当てはまらない相談です。',
                '詳細は別途ご連絡いたします。',
            ],
        ];

        $category = Category::inRandomOrder()->first();

        return [
            'category_id' => $category->id,
            'first_name' => $this->faker->firstName,
            'last_name'  => $this->faker->lastName,
            'gender'     => $this->faker->numberBetween(1,3),
            'email'      => $this->faker->unique()->safeEmail,
            'tel'        => $this->faker->phoneNumber,
            'address'    => $this->faker->address,
            'building'   => $this->faker->optional()->secondaryAddress,
            'detail'     => $this->faker->randomElement($detailsByCategory[$category->content]),
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}
