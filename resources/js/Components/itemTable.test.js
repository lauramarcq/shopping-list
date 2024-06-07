import { shallowMount } from "@vue/test-utils";
import ItemTable from "@/Components/ItemTable.vue";

describe("ItemTable", () => {
    let wrapper, list;
    beforeEach(() => {
        list = [
            {
                items: [
                    { id: 1, name: "Item 1", price: 10 },
                    { id: 2, name: "Item 2", price: 20 },
                ],
            },
        ];

        wrapper = shallowMount(ItemTable, {
            props: {
                list,
            },
        });
    });
    it("renders the table with correct number of rows", () => {
        expect(wrapper.findAll("tr")).toHaveLength(list[0].items.length + 1); // +1 for the table header row
    });

    it("renders the correct headers", () => {
        const thElements = wrapper.findAll("th");
        expect(thElements).toHaveLength(2);
        expect(thElements[0].text()).toBe("Name");
        expect(thElements[1].text()).toBe("Price");
    });

    it("it displays the correct data for each row", () => {
        const tdElements = wrapper.findAll("td");
        expect(tdElements).toHaveLength(list[0].items.length * 2);
        expect(tdElements[0].text()).toBe(list[0].items[0].name);
        expect(tdElements[1].text()).toBe(`£ ${list[0].items[0].price}`);
        expect(tdElements[2].text()).toBe(list[0].items[1].name);
        expect(tdElements[3].text()).toBe(`£ ${list[0].items[1].price}`);
    });
});
