import { shallowMount } from "@vue/test-utils";
import ItemTable from "@/Components/ItemTable.vue";

describe("ItemTable", () => {
    let wrapper, list;
    beforeEach(() => {
        list = {
            items: [
                { id: 1, name: "Item 1", price: 10, button: "Delete" },
                { id: 2, name: "Item 2", price: 20, button: "Delete" },
            ],
        };

        wrapper = shallowMount(ItemTable, {
            props: {
                list,
            },
        });
    });
    it("renders the table with correct number of rows", () => {
        expect(wrapper.findAll("tr")).toHaveLength(list.items.length + 1); // +1 for the table header row
    });

    it("renders the correct headers", () => {
        const thElements = wrapper.findAll("th");
        expect(thElements).toHaveLength(3);
        expect(thElements[0].text()).toBe("Name");
        expect(thElements[1].text()).toBe("Price");
        expect(thElements[2].text()).toBe("Actions");
    });

    it("it displays the correct data for each row", () => {
        const tdElements = wrapper.findAll("td");
        expect(tdElements).toHaveLength(list.items.length * 3);
        expect(tdElements[0].text()).toBe(list.items[0].name);
        expect(tdElements[1].text()).toBe(`£ ${list.items[0].price}`);
        expect(tdElements[2].text()).toBe(list.items[0].button);
        expect(tdElements[3].text()).toBe(list.items[1].name);
        expect(tdElements[4].text()).toBe(`£ ${list.items[1].price}`);
        expect(tdElements[5].text()).toBe(list.items[1].button);
    });
});
